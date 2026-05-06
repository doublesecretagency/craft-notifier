## Field Conditions

Field conditions gate the notification on the **element's content**, using Craft's native [conditions](https://craftcms.com/docs/5.x/extend/conditions.html) framework. Build a rule set against the element's attributes and field values, and the notification will be dispatched only when every rule matches.

<img class="dropshadow" src="/images/events/field-conditions.png" alt="" style="width:584px; margin-top:10px">

:::warning Conditions evaluated using "AND"
The condition builder evaluates every rule with **AND** semantics, so each rule must pass for the notification to dispatch.

To send a notification when **either** of two conditions is true, create separate notifications, one per branch.
:::
