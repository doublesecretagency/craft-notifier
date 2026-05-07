## Field Conditions

Field conditions restrict the notification based on the **element's content**, using Craft's native [conditions](https://craftcms.com/docs/5.x/extend/conditions.html) framework. Build a rule set against the element's attributes and field values, and the notification will be dispatched only when every rule matches.

<img class="dropshadow" src="/images/events/field-conditions.png" alt="" style="width:600px; margin-top:10px">

### The "has changed" operator

Field rules now include an additional **"has changed"** operator, alongside the existing standard options.

When the element is saved, the "has changed" operator checks whether the field's value has changed during the save, (regardless of what the new value is). The notification will only be sent when the specified field's value has changed.

:::warning Conditions evaluated using "AND"
The condition builder evaluates every rule with **AND** semantics, so each rule must pass for the notification to be dispatched. 

To send a notification when **either** of two conditions is true, create separate notifications (one per branch).
:::
