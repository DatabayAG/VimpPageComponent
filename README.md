VimpPageComponent
============

### Description

This is an open source project forked from https://github.com/fluxapps/VimpPageComponent

This is an additional Plugin for the ViMP Plugin, thus it only works with ViMP installed (
see https://github.com/DatabayAG/ViMP).
It allows you to add videos from ViMP in any Text-Media-Editor in ILIAS.

### Installation

Start at your ILIAS root directory

```bash
mkdir -p public/Customizing/global/plugins/Services/COPage/PageComponent/
cd public/Customizing/global/plugins/Services/COPage/PageComponent
git clone https://github.com/DatabayAG/VimpPageComponent
```

Rebuild the plugin artifact so Setup and the administration GUI know the plugin, then install it:

```bash
cd [ILIAS-10-Docroot]
php cli/setup.php build
php cli/setup.php install --legacy-plugin VimpPageComponent -y
```

`php cli/setup.php build` is required after cloning and after changes to `plugin.php`. Without it, Setup still uses the previous plugin data.

Alternatively, as ILIAS administrator go to "Administration -> Plugins" and install/activate the plugin (after `php cli/setup.php build`).
