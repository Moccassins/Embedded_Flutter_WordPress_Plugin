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

    /** 
     *  currently there is a restriction that there can only be one instance of a flutter application per page.
     *  this is because the flutter engine currently accesses static properties on the window to manage the state of the application. 
     *  multiple instances would lead to conflicts. the problem is known. @see: https://github.com/flutter/flutter/issues/121374
     */
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
