# Embedded Flutter WordPress Plugin
This plugin allows you to render a Flutter application within WordPress as an embedded component. It's designed to be generic, enabling developers to easily clone, enrich with their own Flutter application, and extend as needed.
This Feature was announced in the Flutter Summit of 2023. You can rewatch the relevant part here:

[![Video Name](https://img.youtube.com/vi/zKQYGKAe5W8/0.jpg)](https://www.youtube.com/live/zKQYGKAe5W8?si=YWBKOAiITJ6HLtg9&t=5796)

The demo app presented in that Video can be found here: https://flutter-forward-demos.web.app/#/

## Table of Contents

- [Configuration](#configuration)
- [Installation](#installation)
- [Limitations](#limitations)
- [Further Information](#further-information)
- [Contributing](#contributing)
- [License](#license)

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

After the configuration and customization is done, you can install the Plugin in an WordPress Website as follows:

1. Zip the folder that Contains your Plugin. You can for example just zip the Sample folder from this repository.
2. Login to your WordPress Website and switch to the Plugins Tab.
3. Upload the Zip file and activate the plugin.
4. On the place you want to add The Plugin, you can currently add the Plugin by using the shortcode you have configured.
   For the sample application it would be `[my_flutter_app]` on a pure WordPress. If you are using Divi, you could just add
   the created My Flutter App Module. There arent any further Configuration posibilitys in the Sample plugin besides width and height which are defaulted to 300px.

## Limitations

Since the whole embedded feature in Flutter is still in beta status, there are of course a few restrictions.

1. Currently only one Flutter application can be hosted per page/post. No matter if in the header, body or footer. Only one application and also only one instance of the application is possible.
   Adding multiple shortcodes will only result in one of the shortcodes being used. This is because Flutter itself defines constants on the window, which would lead to conflicts if instanced multiple times.
   The problem is already known to the Flutter team. No timeframe for a solution has been announced yet. More details here: https://github.com/flutter/flutter/issues/121374

3. This all works only in Flutter and Dart up from version 3. currently the beta channel should be used until the Flutter team has merged everything into the stable.

## Further Information

There are additional interoperabilitys between the Flutter code and your existing Website using JavaScript that i dont have covered. You can watch these Video for further Information about that:

[![Video Name](https://img.youtube.com/vi/3HdTJPd6eZc/0.jpg)](https://www.youtube.com/watch?v=3HdTJPd6eZc)


## Contributing

Contributions are welcome! Please create a pull request with your changes or open an issue if you find a bug or want to suggest a feature.

## License

This plugin is licensed under the MIT License. See [LICENSE](LICENSE.md) for more details.
