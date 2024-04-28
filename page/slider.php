<div class="slider">
      <div class="lista">
        <div class="item">
          <img src="img/banner/banner1.png">
        </div>
        <div class="item">
          <img src="img/banner/banner2.png">
        </div>
        <div class="item">
          <img src="img/banner/banner3.png">
        </div>
        <div class="item">
          <img src="img/banner/banner4.png">
        </div>
        <div class="item">
          <img src="img/banner/banner5.png">
        </div>
        <div class="item">
          <img src="img/banner/banner6.png">
        </div>
      </div>
      <div class="bat"><!--button prev and next-->
        <button id="prev">&#60;</button>
        <button id="next">&#62;</button>
      </div>
      <ul class="dots"><!--dots-->
        <li class="active"></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
      </ul>
    </div>
    <script>
      let list = document.querySelector('.slider .lista');
      let items = document.querySelectorAll('.slider .lista .item');
      let dots = document.querySelectorAll('.slider .dots li');
      let prev = document.getElementById('prev');
      let next = document.getElementById('next');
      let active = 0;
      let lenghItems = items.length - 1;
      next.onclick = function () {
        if (active + 1 > lenghItems) {
          active = 0;
        }
        else {
          active += 1;
        }
        reloadSlider();
      }
      prev.onclick = function () {
        if (active - 1 < 0) {
          active = lenghItems;
        }
        else {
          active -= 1;
        }
        reloadSlider();
      }
      let refreshSlider = setInterval(() => { next.click() }, 4000)
      function reloadSlider() {
        let checkLeft = items[active].offsetLeft;
        list.style.left = -checkLeft + 'px';

        let lastActiveDot = document.querySelector('.slider .dots li.active');
        lastActiveDot.classList.remove('active');
        dots[active].classList.add('active');
        clearInterval(refreshSlider);
        refreshSlider = setInterval(() => { next.click() }, 6000);
      }
      dots.forEach((li, key) => {
        li.addEventListener('click', function () {
          active = key;
          reloadSlider();
        })
      })
    </script>