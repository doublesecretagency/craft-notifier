<script setup>
// Custom 404 recovery page. Renders in the default theme's `not-found` slot,
// so the nav, footer, and search box stay in place around it. A centered
// two-column split: a plain, non-alarmist message plus search on the left,
// and an elevated panel of destinations on the right. Both sit above the fold.

import { withBase } from 'vitepress'

// Destinations to offer as recovery links (directory pages, so trailing slash)
const sections = [
  { text: 'Getting Started', link: '/getting-started/', note: 'Learn how to get going with Notifier.' },
  { text: 'Events', link: '/events/', note: 'Each notification is triggered by a specific event.' },
  { text: 'Messages', link: '/messages/', note: 'A wide variety of message types are supported.' },
  { text: 'Recipients', link: '/recipients/', note: 'Select which recipients will receive the message.' },
]

// Open the existing local search modal by clicking the nav search button
function openSearch() {
  // Get the nav search trigger (VitePress local search reuses the DocSearch button markup)
  const btn = document.querySelector('.DocSearch-Button') || document.querySelector('.VPNavBarSearch button')
  // If found, open the modal
  if (btn) {
    btn.click()
  }
}
</script>

<template>
  <div class="NF">
    <!-- Left: plain message + search -->
    <div class="NF-intro">
      <p class="NF-kicker">404 · Page not found</p>
      <h1 class="NF-title">The page you're looking for doesn't exist.</h1>
      <p class="NF-lead">Sorry about that, something may have moved recently.</p>
      <p class="NF-lead">Please select a subject to get back on track, or click the search button to find what you're looking for.</p>
      <button type="button" class="NF-search" @click="openSearch">
        <span class="vpi-search NF-search-icon" />
        Search the docs
      </button>
    </div>

    <!-- Right: destinations -->
    <nav class="NF-panel" aria-label="Documentation sections">
      <a
        v-for="(section, i) in sections"
        :key="i"
        class="NF-dest"
        :href="withBase(section.link)"
      >
        <span class="NF-dest-main">
          <span class="NF-dest-text">{{ section.text }}</span>
          <span class="NF-dest-note">{{ section.note }}</span>
        </span>
        <span class="NF-dest-arrow">→</span>
      </a>
    </nav>
  </div>
</template>

<style scoped>
.NF {
  display: grid;
  grid-template-columns: 1fr 1fr;
  align-items: center;
  gap: 56px;
  max-width: 940px;
  margin: 0 auto;
  padding: 32px 24px 64px;
  /* Center the block in the viewport so destinations stay above the fold */
  min-height: calc(100vh - var(--vp-nav-height) - 96px);
  /* Hover accent: the brand red is too dark on a dark background, so use a lighter tint there */
  --nf-accent: var(--vp-c-brand-1);
}

.dark .NF {
  --nf-accent: #f0795a;
}

/* ===== Left: intro ===== */

.NF-kicker {
  font-size: 13px;
  font-weight: 600;
  letter-spacing: 0.08em;
  text-transform: uppercase;
  color: var(--vp-c-text-2);
}

.NF-title {
  margin-top: 14px;
  margin-bottom: 16px;
  font-size: 22px;
  font-weight: 650;
  line-height: 1.15;
  letter-spacing: -0.02em;
  border: none;
}

.NF-lead {
  margin-top: 14px;
  font-size: 16px;
  line-height: 1.6;
  color: var(--vp-c-text-2);
}

.NF-search {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  gap: 8px;
  margin-top: 28px;
  margin-bottom: 40px;
  border-radius: 8px;
  padding: 0 24px;
  min-width: 230px;
  height: 46px;
  font-size: 15px;
  font-weight: 600;
  color: var(--vp-c-white);
  background-color: var(--vp-c-brand-1);
  transition: background-color 0.25s;
}

.NF-search:hover {
  /* Darken the red rather than swap to gold (white text fails contrast on gold) */
  filter: brightness(0.9);
}

.NF-search-icon {
  width: 16px;
  height: 16px;
}

/* ===== Right: destinations panel ===== */

.NF-panel {
  display: flex;
  flex-direction: column;
  border-radius: 6px;
  border: 1px solid var(--vp-c-divider);
  background-color: var(--vp-c-bg-soft);
  overflow: hidden;
}

.NF-dest {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 16px;
  padding: 16px 20px;
  border-bottom: 1px solid var(--vp-c-divider);
  transition: background-color 0.2s;
}

.NF-dest:last-child {
  border-bottom: none;
}

.NF-dest:hover {
  /* Neutral tint that's visibly lighter in both modes (bg-elv == bg-soft in dark) */
  background-color: var(--vp-c-default-soft);
}

.NF-dest-main {
  display: flex;
  flex-direction: column;
}

.NF-dest-text {
  font-size: 15px;
  font-weight: 600;
  color: var(--vp-c-text-1);
  transition: color 0.2s;
}

.NF-dest:hover .NF-dest-text {
  color: var(--nf-accent);
}

.NF-dest-note {
  margin-top: 3px;
  font-size: 13px;
  color: var(--vp-c-text-2);
}

.NF-dest-arrow {
  flex-shrink: 0;
  font-size: 18px;
  color: var(--vp-c-text-2);
  transition: transform 0.2s, color 0.2s;
}

.NF-dest:hover .NF-dest-arrow {
  color: var(--nf-accent);
  transform: translateX(4px);
}

/* ===== Responsive: stack on narrow screens ===== */

@media (max-width: 768px) {
  .NF {
    grid-template-columns: 1fr;
    gap: 32px;
    align-content: center;
    min-height: calc(100vh - var(--vp-nav-height) - 64px);
  }
}
</style>
