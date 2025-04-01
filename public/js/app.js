function isHTML(str) {
  console.log(str)
  var a = document.createElement('div');
  a.innerHTML = str.trim();
  return (a.childNodes.length > 0);
}
function getCurrentTime() {
  var now = new Date();
  var year = now.getFullYear();
  var month = (now.getMonth() + 1).toString().padStart(2, '0');
  var day = now.getDate().toString().padStart(2, '0');
  var hour = now.getHours().toString().padStart(2, '0');
  var minute = now.getMinutes().toString().padStart(2, '0');
  var second = now.getSeconds().toString().padStart(2, '0');
  var formattedDate = year + '-' + month + '-' + day;
  var formattedTime = hour + ':' + minute + ':' + second;
  var dateTime = formattedDate + ' ' + formattedTime;
  return dateTime;
}

function generateRandomString(length) {
  let result = '';
  const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
  const charactersLength = characters.length;
  for (let i = 0; i < length; i++) {
      result += characters.charAt(Math.floor(Math.random() * charactersLength));
  }
  return result;
}
async function fetchAndDownload(imageSrc) {
  try {
    const response = await fetch(imageSrc);
    const imageBlob = await response.blob(); // 将响应体转换为Blob对象

    // 创建一个隐藏的`<a>`元素
    const link = document.createElement('a');
    link.href = URL.createObjectURL(imageBlob);
    // 设置下载文件名 随机生成字符串
    link.download = generateRandomString(6) + ".png";
    document.body.appendChild(link);
    link.click();

    // 清理并移除`<a>`元素
    URL.revokeObjectURL(link.href);
    document.body.removeChild(link);
  } catch (error) {
    console.error('Fetch and download error:', error);
  }
}

function toast(msg) {
  var toast = document.getElementById('toast');
  var msgElement = document.getElementById('msg');
  toast.classList.remove('hidden');
  msgElement.textContent = msg;
  setTimeout(function() {
      toast.classList.add('hidden');
      msgElement.textContent = '';
  }, 2000);
}