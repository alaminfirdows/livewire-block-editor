import "./bootstrap";

window.blockEditor = function (params) {
    console.log({
        ...params,
        hello: "world",
    });

    return {
        ...params,
        hello: "world",
    };
};
