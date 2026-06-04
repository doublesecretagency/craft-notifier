// Event editor enhancements for the notification edit screen:
// the date-reached offset toggle, and the recurring-schedule controls plus
// the live "Upcoming scheduled runs" preview. The preview math mirrors
// RecurringSchedule.php exactly so it never disagrees with the real scheduler.
(function () {

    // Wire up every date-reached and recurring-schedule row on the page
    const init = () => {

        // Loop through each date-reached row on the page
        document.querySelectorAll('.notifier-date-reached').forEach((row) => {
            // Get the direction dropdown and the offset wrapper
            const direction = row.querySelector('.notifier-date-reached-direction select');
            const offset = row.querySelector('.notifier-date-reached-offset');
            // If either control is missing, bail
            if (!direction || !offset) {
                return;
            }
            // Show or hide the offset based on the direction
            const sync = () => {
                offset.classList.toggle('hidden', 'on' === direction.value);
            };
            // Sync whenever the direction changes
            direction.addEventListener('change', sync);
            // Sync once to set the initial state
            sync();
        });

        // Loop through each recurring-schedule row on the page
        document.querySelectorAll('.notifier-recurring-schedule').forEach((row) => {
            // Get the controls
            const freq = row.querySelector('.notifier-recurring-frequency select');
            const intervalInput = row.querySelector('.notifier-recurring-interval input');
            const weekly = row.querySelector('.recurring-frequency-weekly');
            const monthly = row.querySelector('.recurring-frequency-monthly');
            const yearly = row.querySelector('.recurring-frequency-yearly');
            const dow = weekly ? weekly.querySelector('select') : null;
            const domMonthly = monthly ? monthly.querySelector('input') : null;
            const domYearly = yearly ? yearly.querySelector('input') : null;
            const pinMonth = yearly ? yearly.querySelector('select') : null;
            const time = row.querySelector('input[type="time"]');
            // If the frequency control is missing, bail
            if (!freq) {
                return;
            }
            // Read the locale + timezone the server rendered into the wrapper
            const locale = row.dataset.locale || 'en';
            const timeZone = row.dataset.timezone || 'UTC';
            const readOnly = ('1' === row.dataset.readonly);
            // Find the start-date input and the preview table rows (siblings in the wrapper)
            const wrapper = row.closest('.notifier-recurring-wrapper');
            const startDate = wrapper ? wrapper.querySelector('.notifier-recurring-start input') : null;
            const nextWrap = wrapper ? wrapper.querySelector('.notifier-recurring-next') : null;
            const runRows = nextWrap ? Array.from(nextWrap.querySelectorAll('tbody tr')) : [];
            const cadenceSpan = wrapper ? wrapper.querySelector('.notifier-recurring-cadence') : null;

            // Cadence summary words (singular, plural) per unit, mirrored from the template
            const cadenceWords = {
                daily: ['day', 'days'],
                weekly: ['week', 'weeks'],
                monthly: ['month', 'months'],
                yearly: ['year', 'years'],
            };

            // Read the interval as a whole number, at least 1
            const interval = () => {
                const v = intervalInput ? parseInt(intervalInput.value || '1', 10) : 1;
                return Math.max(1, isNaN(v) ? 1 : v);
            };
            // Read the ISO weekday (1-7), defaulting to Monday
            const dowValue = () => {
                const v = dow ? parseInt(dow.value || '1', 10) : 1;
                return Math.min(7, Math.max(1, isNaN(v) ? 1 : v));
            };
            // Read the day of month (1-28) from whichever block is active
            const domValue = () => {
                const el = ('yearly' === freq.value) ? domYearly : domMonthly;
                const v = el ? parseInt(el.value || '1', 10) : 1;
                return Math.min(28, Math.max(1, isNaN(v) ? 1 : v));
            };
            // Read the pin month (1-12), defaulting to January
            const pinMonthValue = () => {
                const v = pinMonth ? parseInt(pinMonth.value || '1', 10) : 1;
                return Math.min(12, Math.max(1, isNaN(v) ? 1 : v));
            };

            // Update the trailing cadence summary (e.g. "every 2 weeks after that")
            const updateCadence = () => {
                if (!cadenceSpan) {
                    return;
                }
                const n = interval();
                const words = cadenceWords[freq.value] || cadenceWords.weekly;
                // Drop the count for a single interval (e.g. "every week", not "every 1 week")
                cadenceSpan.textContent = (1 === n)
                    ? Craft.t('notifier', words[0])
                    : (n + ' ' + Craft.t('notifier', words[1]));
            };

            // Show or hide the pin controls based on the frequency
            const syncVisibility = () => {
                if (weekly) {
                    weekly.classList.toggle('hidden', 'weekly' !== freq.value);
                }
                if (monthly) {
                    monthly.classList.toggle('hidden', 'monthly' !== freq.value);
                }
                if (yearly) {
                    yearly.classList.toggle('hidden', 'yearly' !== freq.value);
                }
                // The monthly and yearly blocks share a [dayOfMonth] name, so only the active one may post
                if (!readOnly && domMonthly && domYearly) {
                    const yearlyActive = ('yearly' === freq.value);
                    domYearly.disabled = !yearlyActive;
                    domMonthly.disabled = yearlyActive;
                }
            };

            // Read "now" as wall-clock fields in the system timezone
            const wallNow = () => {
                const parts = new Intl.DateTimeFormat('en-US', {
                    timeZone, year: 'numeric', month: 'numeric', day: 'numeric',
                    hour: 'numeric', minute: 'numeric', second: 'numeric', hour12: false,
                }).formatToParts(new Date());
                const get = (t) => parseInt(parts.find((p) => p.type === t).value, 10);
                let h = get('hour');
                // Intl can report midnight as 24 under hour12:false
                if (24 === h) {
                    h = 0;
                }
                return {y: get('year'), mo: get('month'), d: get('day'), h: h, mi: get('minute'), s: get('second')};
            };

            // Parse the configured time into [hour, minute]
            const parseTime = () => {
                const m = /^(\d{1,2}):(\d{2})$/.exec((time && time.value) || '09:00');
                if (!m) {
                    return [9, 0];
                }
                return [Math.min(23, parseInt(m[1], 10)), Math.min(59, parseInt(m[2], 10))];
            };

            // Parse the start date into {y, mo, d}, treating a missing value as the epoch (no floor)
            const parseStart = () => {
                const v = (startDate && startDate.value) || '';
                const m = /^(\d{4})-(\d{2})-(\d{2})$/.exec(v);
                if (!m) {
                    return {y: 1970, mo: 1, d: 1};
                }
                return {y: parseInt(m[1], 10), mo: parseInt(m[2], 10), d: parseInt(m[3], 10)};
            };

            // Build the anchor: the first on-pin slot at or after the start date (mirrors RecurringSchedule.php)
            const buildAnchor = (h, mi) => {
                const s = parseStart();
                const start = new Date(Date.UTC(s.y, s.mo - 1, s.d, h, mi, 0));
                const f = freq.value;
                // Daily: the start date itself
                if ('daily' === f) {
                    return start;
                }
                // Weekly: the first matching weekday on or after the start date
                if ('weekly' === f) {
                    const target = dowValue();
                    for (let i = 0; i <= 7; i++) {
                        const c = new Date(Date.UTC(s.y, s.mo - 1, s.d + i, h, mi, 0));
                        const iso = (0 === c.getUTCDay() ? 7 : c.getUTCDay());
                        if (iso === target) {
                            return c;
                        }
                    }
                    return start;
                }
                // Monthly: this month's day, or next month's if it's before the start
                if ('monthly' === f) {
                    const dim = domValue();
                    let c = new Date(Date.UTC(s.y, s.mo - 1, dim, h, mi, 0));
                    if (c.getTime() < start.getTime()) {
                        c = new Date(Date.UTC(s.y, s.mo, dim, h, mi, 0));
                    }
                    return c;
                }
                // Yearly: this year's month and day, or next year's if it's before the start
                const pm = pinMonthValue(), dim = domValue();
                let c = new Date(Date.UTC(s.y, pm - 1, dim, h, mi, 0));
                if (c.getTime() < start.getTime()) {
                    c = new Date(Date.UTC(s.y + 1, pm - 1, dim, h, mi, 0));
                }
                return c;
            };

            // Advance a slot forward by a count of frequency units, re-pinning + re-applying the time
            const advance = (d, count, h, mi) => {
                const y = d.getUTCFullYear(), mo = d.getUTCMonth(), day = d.getUTCDate();
                const f = freq.value;
                // Daily: add days
                if ('daily' === f) {
                    return new Date(Date.UTC(y, mo, day + count, h, mi, 0));
                }
                // Weekly: add weeks
                if ('weekly' === f) {
                    return new Date(Date.UTC(y, mo, day + count * 7, h, mi, 0));
                }
                // Monthly: add months, re-pinning the day
                if ('monthly' === f) {
                    return new Date(Date.UTC(y, mo + count, domValue(), h, mi, 0));
                }
                // Yearly: add years, re-pinning the month and day
                return new Date(Date.UTC(y + count, pinMonthValue() - 1, domValue(), h, mi, 0));
            };

            // Estimate how many whole interval-periods fit between the anchor and the reference
            const periodsBetween = (anchor, refMs, n) => {
                const aMs = anchor.getTime();
                const f = freq.value;
                let units;
                if ('daily' === f) {
                    units = Math.floor((refMs - aMs) / 86400000);
                } else if ('weekly' === f) {
                    units = Math.floor((refMs - aMs) / (7 * 86400000));
                } else if ('monthly' === f) {
                    const ref = new Date(refMs);
                    units = (ref.getUTCFullYear() - anchor.getUTCFullYear()) * 12 + (ref.getUTCMonth() - anchor.getUTCMonth());
                } else {
                    units = new Date(refMs).getUTCFullYear() - anchor.getUTCFullYear();
                }
                return Math.floor(Math.max(0, units) / Math.max(1, n));
            };

            // Compute the next fire moment as a wall-clock UTC calendar value (for display only)
            const computeNext = () => {
                const now = wallNow();
                const [h, mi] = parseTime();
                const refMs = Date.UTC(now.y, now.mo - 1, now.d, now.h, now.mi, now.s);
                const n = interval();
                const anchor = buildAnchor(h, mi);
                // If the anchor is still ahead of now, that's the next run
                if (anchor.getTime() > refMs) {
                    return anchor;
                }
                // Otherwise jump by whole intervals, then correct any estimate slack
                const k = periodsBetween(anchor, refMs, n);
                let cand = advance(anchor, k * n, h, mi);
                while (cand.getTime() <= refMs) {
                    cand = advance(cand, n, h, mi);
                }
                return cand;
            };

            // Compute the next N fire moments as wall-clock UTC calendar values
            const computeRuns = (count) => {
                const [h, mi] = parseTime();
                const n = interval();
                const runs = [];
                let cand = computeNext();
                for (let i = 0; i < count; i++) {
                    runs.push(cand);
                    cand = advance(cand, n, h, mi);
                }
                return runs;
            };

            // Re-render the preview table (one row per upcoming run)
            const render = () => {
                if (!runRows.length) {
                    return;
                }
                const runs = computeRuns(runRows.length);
                // Format the wall-clock fields as-is (UTC so no further shift is applied)
                const dayFmt = new Intl.DateTimeFormat(locale, {weekday: 'long', timeZone: 'UTC'});
                const dateFmt = new Intl.DateTimeFormat(locale, {dateStyle: 'long', timeZone: 'UTC'});
                const timeFmt = new Intl.DateTimeFormat(locale, {timeStyle: 'short', timeZone: 'UTC'});
                // Fill each row with its run's day, date, and time
                runRows.forEach((tr, i) => {
                    const cand = runs[i];
                    tr.querySelector('.run-day').textContent = dayFmt.format(cand);
                    tr.querySelector('.run-date').textContent = dateFmt.format(cand);
                    tr.querySelector('.run-time').textContent = timeFmt.format(cand);
                });
            };

            // Sync visibility, preview, and cadence summary together
            const sync = () => {
                syncVisibility();
                render();
                updateCadence();
            };

            // Recompute on any control change
            [freq, intervalInput, dow, domMonthly, domYearly, pinMonth, time, startDate].forEach((el) => el && el.addEventListener('change', sync));
            [intervalInput, domMonthly, domYearly, time, startDate].forEach((el) => el && el.addEventListener('input', sync));

            // Set the initial state
            sync();
        });

    };

    // Run once the DOM is ready
    if ('loading' === document.readyState) {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }

})();
