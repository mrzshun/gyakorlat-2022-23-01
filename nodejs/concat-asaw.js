const { readdir: pReadDir, readFile: pReadFile, writeFile: pWriteFile } = require('fs/promises');

(async () => {
   const files = await pReadDir('./input');
   console.log(files);
   console.log('end');
})()

// IIFE
// (async () => {
//     ...
// })()

// pReadDir('./input')
//     .then( files => {
//         console.log(files);
//         return Promise.all(
//             files.map(file => pReadFile("./input/".concat(file),"utf-8"))
//         );
//     })
//     .then(contents => {
//         let output = contents.join(", ");
//         return pWriteFile("./output/callback.txt",output);
//     })
//     .then(() => {
//         console.log("end");
//     })
//     .catch(error => {
//         throw error;
//     })