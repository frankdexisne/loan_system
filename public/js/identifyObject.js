function identifyType(object) {
    if (object === null) {
        return "null";
    }

    if (object === undefined) {
        return "undefined";
    }

    if (object.constructor === "string".constructor) {
        return "String";
    }

    if (object.constructor === [].constructor) {
        return "Array";
    }

    if (object.constructor === ({}).constructor) {
        return "Object";
    }
    {
        return "don't know";
    }
}
