## How it fires

Each notification keeps track of the last time it was run.

When the schedule runs, notifications are sent for all elements whose date occurred since the previous run.

After running, the last runtime is updated, and the cycle repeats. Each element fires exactly once.
