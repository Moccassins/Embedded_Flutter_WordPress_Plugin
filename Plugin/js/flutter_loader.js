document.addEventListener("DOMContentLoaded", function () {
    // Embed flutter into div#flutter_target
    let targets = document.querySelectorAll("div[id^='" + flutterData.pluginId + "_']"); // Änderung hier
    let assetBase = flutterData.flutterPluginPath;

    if (!assetBase) {
        console.error("Flutter plugin path is not set!");
        return;
    }

    if (!targets || targets.length === 0) {
        console.error("Flutter targets not found!");
        return;
    }

    // Jetzt werden alle gefundenen Ziele durchlaufen
    targets.forEach(target => {
        if (!target) {
            console.error("Flutter target was not found!");
            return;
        }

        _flutter.loader.loadEntrypoint({
            onEntrypointLoaded: async function (engineInitializer) {
                let appRunner = await engineInitializer.initializeEngine({
                    hostElement: target,
                    assetBase: assetBase,
                });
                await appRunner.runApp();
            },
        });
    });
});
