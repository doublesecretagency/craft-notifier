## User Group Filters

Choose which [user groups](https://craftcms.com/docs/5.x/system/user-management.html#user-groups) should fire this notification. Only users belonging to one of the selected groups will trigger it, and a user in multiple selected groups still receives only a single notification.

**Ungrouped Users** are users who belong to no group at all.

<img class="dropshadow" src="/images/events/user-group-filters.png" alt="" style="width:395px; margin-top:10px">

:::warning Selection is required
Check at least one group (or _Ungrouped_), or the notification won't fire.
:::

:::tip Hidden if no groups exist
If no user groups are set up, this filter is skipped and every valid user will receive the notification.
:::
