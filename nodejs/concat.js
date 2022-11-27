const { readdir, readFile, writeFile } = require('fs');

readdir('./input',(error,files) => {
    if(error) throw error;
    const contents = [];
    files.forEach(file => {
        readFile("./input/".concat(file),"utf-8",(error,content) => {
            if(error) throw error;
            contents.push(content);
            if(contents.length == files.length) {
                let output = contents.join(", ");
                writeFile("./output/callback.txt",output,(error) => {
                    if(error) throw error;
                    console.log('end');
                });
            }
        });
    });
});