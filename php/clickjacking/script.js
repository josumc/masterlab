const opacitySlider = document.getElementById("opacitySlider");
const maliciousFrame = document.getElementById("maliciousFrame");

opacitySlider.addEventListener("input", function () {
  const opacityValue = this.value / 100;
  maliciousFrame.style.opacity = opacityValue;
  mimickFrame.style.opacity = 1 - opacityValue;
});
