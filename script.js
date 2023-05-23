var bigContainer = document.getElementById("photo");
var smallContainers = document.getElementsByClassName("line");
var containerWidth = bigContainer.offsetWidth;
var animationSpeed = 1.5;
var transitionDuration = 1  ; 

function showContainers() {
    var index = 0;
    
    function fadeInContainer() {
      if (index < smallContainers.length) {
        var container = smallContainers[index];
        container.style.transition = "opacity " + transitionDuration + "s ease-in-out";
        container.style.opacity = "1";
        index++;
        setTimeout(fadeInContainer, animationSpeed * 1000);
      }
    }

    setTimeout(fadeInContainer, transitionDuration * 1000);
  }
  
  for (var i = 0; i < smallContainers.length; i++) {
    smallContainers[i].style.opacity = "0";
  }
  
  window.addEventListener("load", showContainers);