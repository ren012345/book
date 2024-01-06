const tabLabels = document.querySelectorAll(".tab_label");
const tabPanels = document.querySelectorAll(".tab_panel");

tabLabels.forEach(function (label, index) {
  label.addEventListener("click", function () {
    // クリックされたラベルのインデックスを取得
    const clickedIndex = Array.from(tabLabels).indexOf(label);
    
    // すべてのラベルとパネルから 'active' クラスを削除
    tabLabels.forEach(function (label) {
      label.classList.remove("active");
    });
    tabPanels.forEach(function (panel) {
      panel.classList.remove("active");
    });
    
    // クリックされたラベルと対応するパネルに 'active' クラスを追加
    label.classList.add("active");
    tabPanels[clickedIndex].classList.add("active");
  });
});

document.querySelector('.hamburger').addEventListener('click',function() {
  this.classList.toggle('active');
  document.querySelector('.slide-menu').classList.toggle('active');
});
