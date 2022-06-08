  var htmlCollection = document.getElementsByClassName('slide_item');
  //getting elements by class name into an HTMLCollection

  var itemsId = Array.from(htmlCollection);
  //turning the HTMLcollection into an array for easier manipulation of the elements

  var sectionDeg = 360 / itemsId.length;
  //sectioning the (imaginary) circle into a number of section equalling the number of items
  //it can be used on more elements

  var radianSectionDeg = sectionDeg * Math.PI * 2 / 360;
  //transforming from degrees into radians

  var radiusLength = 220;
  //the distance between the center of the circle to the element
  //edit this number to increase/decrease that distance

  for (var i = 0; i < itemsId.length; i++) {
      itemsId[i].style.top = radiusLength * Math.sin(radianSectionDeg * i - 1.5708) + 'px';
      itemsId[i].style.left = radiusLength * Math.cos(radianSectionDeg * i - 1.5708) + 'px';
  }
  //setting the top and left positions of each elemenent based on the following formula:
  //(x, y) = (r * cos(θ), r * sin(θ)) like this:
  //x = (r * cos(θ) => left
  //y = r * sin(θ) => top
  //1.5708 is a radian used put the first element on top - basically 90deg

  function makeATurn() {
      for (var i = 0; i < itemsId.length; i++) {
          itemsId[i].style.top = radiusLength * Math.sin(radianSectionDeg * i - 1.5708) + 'px';
          itemsId[i].style.left = radiusLength * Math.cos(radianSectionDeg * i - 1.5708) + 'px';
      }
  }
  //function used to set the new position of the elements

  function turnRight() {
      var holder = itemsId.pop();
      itemsId.unshift(holder);
      makeATurn();
  }

  function turnLeft() {
      var holder = itemsId.shift();
      itemsId.push(holder);
      makeATurn();
  }

  window.onload = function() {            
    function foo() {
        var holder = itemsId.shift();
      itemsId.push(holder);
      makeATurn();
    }
    setInterval(foo, 3000);
    }
  //we're moving the elements by changing their position in the array