## User Group Filters

User Group filters limit the notification to users in a chosen set of [user groups](https://craftcms.com/docs/5.x/system/user-management.html#user-groups). The user must belong to at least one selected group for the message to be sent. If a user belongs to more than one group, they will only receive a single notification.

**Ungrouped Users** are users who belong to no group at all.

<img class="dropshadow" src="/images/events/user-group-filters.png" alt="" style="width:395px; margin-top:10px">

:::warning Selection is required
At least one group (or _Ungrouped_) must be checked. If no options are selected, nothing will be sent out.
:::

:::tip Hidden if no groups exist
If no user groups exist, this filter will be hidden and notifications are sent to every valid user.
:::
