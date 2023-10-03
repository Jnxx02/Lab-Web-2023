// // 1. Eksponensial
// function eksponen(angka, pangkat) {
//   if (pangkat == 0) {
//     return hasil = 1;
//   } else {
//     let hasil = angka;
//     for (let i = 1; i < pangkat; i++) {
//       hasil *= angka;
//     }
//     return hasil;
//   }
// }

// console.log(eksponen(2, 10));
// console.log(eksponen(3, 4));

// // 2. Chipper Text
// function chipperText(text, n) {
//   let result = "";

//   for (let i = 0; i < text.length; i++) {
//     let char = text[i];

//     if (/[a-zA-Z]/.test(char)) {
//       let isUpperCase = char === char.toUpperCase();
//       let offset = isUpperCase ? 65 : 97;
//       let shiftedChar = String.fromCharCode(((char.charCodeAt(0) - offset + n) % 26) + offset);
//       result += shiftedChar;
//     } else {
//       result += char;
//     }
//   }
//   return result;
// }

// console.log(chipperText("abc", 1));
// console.log(chipperText("Indonesia", 13));

// // 3. Kata Palindrom
// function isPalindrome(word) {
//   word = word.toLowerCase().replace(/\s/g, '');
//   const reversedWord = word.split('').reverse().join('');
//   return word === reversedWord;
// }

// console.log(isPalindrome("malam"));
// console.log(isPalindrome("apa"));
// console.log(isPalindrome("131"));
// console.log(isPalindrome("12321"));
// console.log(isPalindrome("Kodok"));
// console.log(isPalindrome("kasur ini rusak"));
// console.log(isPalindrome("siapa"));

// // 4. Mengurutkan angka dari yang terkecil
// function sortArray(arr) {
//   const n = arr.length;

//   for (let i = 0; i < n - 1; i++) {
//     let index = i;
//     for (let j = i + 1; j < n; j++) {
//       if (arr[j] < arr[index]) {
//         index = j;
//       }
//     }
//     if (index !== i) {
//       const temp = arr[i];
//       arr[i] = arr[index];
//       arr[index] = temp;
//     }
//   }
//   return arr;
// }

// const inputArr = [50, 20, 1, 45, 3];
// console.log(sortArray(inputArr));

// 5. Mengubah angka ke binary
function numberToBinary(number) {
  if (number === 0) {
    return "0";
  }

  let binary = "";
  while (number > 0) {
    let check = number % 2;
    binary = check + binary;
    number = Math.floor(number / 2);
  }
  return binary;
}

console.log(numberToBinary(14));

