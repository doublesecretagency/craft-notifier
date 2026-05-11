## Field Conditions

Field conditions restrict the notification based on the **element's content**, using Craft's native [conditions](https://craftcms.com/docs/5.x/extend/conditions.html) framework. Build a rule set against the element's attributes and field values, and the notification will be dispatched only when every rule matches.

:::warning Must match all conditions
The condition builder evaluates every rule with **AND** semantics, so each rule must pass for the notification to be sent. 
:::
