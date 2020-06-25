const pixels = document.querySelectorAll(".pixel");
const notification = document.createElement("div");
const p1 = document.createElement("p");
const p2 = document.createElement("p");
const p3 = document.createElement("p");

pixels.forEach((pixel) => {
  pixel.addEventListener("click", () => {
    notification.style.display = "flex";
    notification.style.backgroundColor = pixel.style.backgroundColor;

    p1.innerHTML =
      "My top coordinates are: " + "<strong>" + pixel.style.top + "</strong>";
    notification.append(p1);

    p2.innerHTML =
      "My left coordinates are: " + "<strong>" + pixel.style.left + "</strong>";
    notification.append(p2);

    p3.innerHTML = "My color is: " + pixel.style.backgroundColor;
    notification.append(p3);

    notification.classList.add(
      "pixelNotification",
      "animate__animated",
      "animate__flipInY"
    );
    pixel.append(notification);

  });
});

pixels.forEach((pixel) => {
  pixel.addEventListener("mouseleave", () => {
    notification.style.display = "none";
  });
});
