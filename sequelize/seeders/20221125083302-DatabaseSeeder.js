'use strict';
const { User, Post, Category } = require('../models');
const { faker } = require('@faker-js/faker');
var md5 = require('md5');

/** @type {import('sequelize-cli').Migration} */
module.exports = {
    async up(queryInterface, Sequelize) {
        let userNum = faker.datatype.number({
            min: 5,
            max: 10,
        });
        const users = [];
        for (let i = 0; i < userNum; i++) {
            users.push(
                await User.create({
                    name: faker.name.fullName(),
                    email: faker.internet.email(),
                    password: md5("password"),
                })
            );
        }

        let postNum = faker.datatype.number({
            min: 10,
            max: 15,
        });
        const posts = [];
        for (let i = 0; i < postNum; i++) {
            const user = faker.helpers.arrayElement(users);
            posts.push(
                await user.createPost({
                    title: faker.lorem.sentence(),
                    description: faker.lorem.sentences(3),
                    text: faker.lorem.paragraphs(5),
                })
            );
        }

        let catNum = faker.datatype.number({
            min: 8,
            max: 12,
        });
        const categories = [];
        for (let i = 0; i < catNum; i++) {
            categories.push(
                await Category.create({
                    name: faker.lorem.word(),
                    color: faker.internet.color(),
                })
            );
        }

        for (let category of categories) {
            let catPosts = faker.helpers.arrayElements(
                posts,
                faker.datatype.number({
                    min: 0,
                    max: postNum,
                }),
            );
            await category.setPosts(catPosts);
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
