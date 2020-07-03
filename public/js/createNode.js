export const createNode = (nodeName, attributes, ...children) => {
  const element = document.createElement(nodeName);

  for (let attr in attributes) {
    if (typeof attributes[attr] === "function") {
      element.addEventListener(attr, attributes[attr]);
    } else {
      element.setAttribute(attr, attributes[attr]);
    }
  }

  children.forEach((child) => {
    const textNode = document.createTextNode(child);
    element.append(textNode);
  });

  return element;
};
