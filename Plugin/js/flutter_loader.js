window.addEventListener("load", function (ev) {
    // Embed flutter into div#flutter_target
    let target = document.querySelector("#flutter_target");
    let assetBase = flutterData.flutterPluginPath; 

    if (!assetBase) {
        console.error("Flutter plugin path is not set!");
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