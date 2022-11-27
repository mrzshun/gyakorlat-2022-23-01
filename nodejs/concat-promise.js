const { readdir: pReadDir, readFile: pReadFile, writeFile: pWriteFile } = require('fs/promises');
// const { promisify } = require('util');

// const pReadDir = promisify(readdir);
// const pReadFile = promisify(readFile);
// const pWriteFile = promisify(writeFile);

pReadDir('./input')
    .then( files => {
        console.log(files);
        return Promise.all(
            files.map(file => pReadFile("./input/".concat(file),"utf-8"))
        );
    })
    .then(contents => {
        let output = contents.join(", ");
        return pWriteFile("./output/callback.txt",output);
    })
    .then(() => {
        console.log("end");
    })
    .catch(error => {
        throw error;
    })


// readdir('./input',(error,files) => {
//     if(error) throw error;
//     const contents = [];
//     files.forEach(file => {
//         readFile("./input/".concat(file),"utf-8",(error,content) => {
//             if(error) throw error;
//             contents.push(content);
//             if(contents.length == files.length) {
//                 let output = contents.join(", ");
//                 writeFile("./output/callback.txt",output,(error) => {
//                     if(error) throw error;
//                     console.log('end');
//                 });
//             }
//         });
//     });
// });