## Alternative Tribe Template Location

By default, The Events Calendar, Event Tickets and family support placing template overrides within a `tribe-events` sub-folder of the current theme.

That isn't always ideal, though, so this plugin adds support for a further location: `wp-content/tribe-events`.

### Usage

* Install and activate like any other plugin
* Locate any template overrides for The Events Calendar/associated plugins in a new `wp-content/tribe-events` directory
* Enjoy trouble free updates of your theme (parent and child themes alike) without fear of losing calendar customizations

### Caveats

It would be nice to support Event Tickets/Plus but, at time of writing, `Tribe__Tickets__Tickets::getTemplateHierarchy()` is not yet amenable to this.