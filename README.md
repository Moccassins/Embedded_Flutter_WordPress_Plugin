# Embedded Flutter WordPress Plugin
This plugin allows you to render a Flutter application within WordPress as an embedded component. It's designed to be generic, enabling developers to easily clone, enrich with their own Flutter application, and extend as needed.

---

# This Readme file is currently a work in progress. For this reason anything below is mostly a placeholder just to show me how to use the markup.

---

## Table of Contents

- [Usage](#usage)
- [Configuration](#configuration)
- [Installation](#installation)
- [Limitations](#limitations)
- [Contributing](#contributing)
- [License](#license)

## Usage

1. Download the plugin and install it in your WordPress directory under `wp-content/plugins/`.
2. Activate the plugin through the WordPress admin panel.

## Configuration

1. Clone this repository.
2. Replace the sample Flutter application in the `flutter_app/` directory with your own.
3. Change the getBaseUri() function in your flutter.js file as follows:

```javascript
function getBaseURI() {
    return flutterData.flutterPluginPath;
}
```

4. Change the default configuration at the beginning of flutter_wordpress_plugin.php this includes the comment on the start and the:
```php
PluginConfig::set('author', 'Your Name');
PluginConfig::set('name', 'My Flutter App');
PluginConfig::set('id', 'my_flutter_app');
PluginConfig::set('uri', 'yourpage.com');
```
dont forget to adjust the Namespace of the PHP files and includes!

## Installation

Explain how other developers can customize the plugin to use with their own Flutter application:

1. Clone this repository.
2. Replace the sample Flutter application in the `flutter-app/` directory with your own.
3. Make any other desired customizations.
4. Package and install the plugin as described above.

## Limitations

Since the whole embedded feature in Flutter is still in beta status, there are of course a few restrictions.

1. Currently only one Flutter application can be hosted per page/post. No matter if in the header, body or footer. Only one and only one instance of the application is possible. Adding multiple shortcodes will only result in one of the shortcodes being used. This is because Flutter itself defines constants on the window, which would lead to conflicts if instanced multiple times. The problem is already known to the Flutter team. No timeframe for a solution has been announced yet. More details here: https://github.com/flutter/flutter/issues/121374

2. This all works only in Flutter and Dart up from version 3. currently the beta channel should be used until the Flutter team has merged everything into the stable.


## Contributing

Contributions are welcome! Please create a pull request with your changes or open an issue if you find a bug or want to suggest a feature.

## License

This plugin is licensed under the MIT License. See [LICENSE](LICENSE.md) for more details.
