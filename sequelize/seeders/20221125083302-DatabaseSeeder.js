'use strict';
const { User } = require('../models');
const { Post } = require('../models');
const { faker } = require('@faker-js/faker');
var md5 = require('md5');

/** @type {import('sequelize-cli').Migration} */
module.exports = {
    async up(queryInterface, Sequelize) {
        let userNum = faker.datatype.number({ 
            min: 5,
            max: 10,
        });
        for (let i = 0; i<userNum; i++){
            await User.create({
                name: faker.name.fullName(),
                email: faker.internet.email(),
                password: md5("password"),
            });    
        }

        let postNum = faker.datatype.number({ 
            min: 10,
            max: 15,
        });
        for (let i = 0; i<postNum; i++){
            await Post.create({
                name: faker.lorem.sentence(),
                description: faker.lorem.sentences(3),
                text: faker.lorem.paragraphs(5),
            });
        }


    },

    async down(queryInterface, Sequelize) {
        /**
         * Add commands to revert seed here.
         *
         * Example:
         * await queryInterface.bulkDelete('People', null, {});
         */
    }
};
