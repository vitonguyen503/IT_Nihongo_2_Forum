function toggleText() {
  var textBox = document.getElementById("textbox");
  var button = document.getElementById("toggle-button");

  if (textBox.classList.contains("expanded")) {
    textBox.classList.remove("expanded");
    textBox.style.overflow = "hidden";
    button.innerHTML = "Xem thêm";
  } else {
    textBox.classList.add("expanded");
    textBox.style.overflowY = "scroll";
    button.innerHTML = "Thu gọn";
  }
}

document.querySelector(".edit").addEventListener("click", function () {
  // console.log("edit");
  showEditModal();
});

document.querySelector(".tick").addEventListener("click", function () {
  showTickModal();
});

function showEditModal() {
  var modalElement = document.getElementById("editModal");
  if (modalElement) {
    var modal = new bootstrap.Modal(modalElement);
    modal.show();
  } else {
    console.error('Không tìm thấy phần tử với id="editModal"');
  }
}

function showTickModal() {
  var modalElement = document.getElementById("tickModal");
  if (modalElement) {
    var modal = new bootstrap.Modal(modalElement);
    modal.show();
  } else {
    console.error('Không tìm thấy phần tử với id="tickModal"');
  }
}

document.addEventListener("DOMContentLoaded", function () {
  // Sử dụng fetch để tải nội dung từ checkedit.html
  fetch("admincheckedit.html")
    .then((response) => response.text())
    .then((data) => {
      // Chèn nội dung vào div có id "modal-container"
      document.getElementById("modal-container").innerHTML = data;

      // Khởi tạo modal với Bootstrap
      var editModal = new bootstrap.Modal(
        document.getElementById("editModal"),
        {}
      );
    })
    .catch((error) => console.error("Error loading modal content:", error));
});

document.addEventListener("DOMContentLoaded", function () {
  // Sử dụng fetch để tải nội dung từ checkedit.html
  fetch("admincheckedit.html")
    .then((response) => response.text())
    .then((data) => {
      // Chèn nội dung vào div có id "modal-container"
      document.getElementById("modal-container").innerHTML = data;

      // Khởi tạo modal với Bootstrap
      var editModal = new bootstrap.Modal(
        document.getElementById("editModal"),
        {}
      );
    })
    .catch((error) => console.error("Error loading modal content:", error));
});