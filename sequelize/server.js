

const { User, Post, Category } = require('./models');

// CommonJs
const fastify = require('fastify')({
    logger: true
});

// // Declare a route
// fastify.get('/', (request, reply) => {
//     reply.send({ hello: 'hello' })
// });

// fastify.get('/hello-world', (request, reply) => {
//     reply.send({ hello: 'world' })
// });

// fastify.get('/hello-world/:id', (request, reply) => {
//     reply.send({ hello: 'id: '.concat(request.params.id) })
// });

// fastify.get('/posts', async (request, reply) => {
//     reply.send(
//         await Post.findAll({
//             // A bejegyzésből csak az id, title és text mezők jelenjenek meg
//             attributes: ["id", "title", "text"],
//             // És a bejegyzés tartalmazza még...
//             include: [
//                 {
//                     // ... a kategória modelt ...
//                     model: Category,
//                     // ... mint "Categories" alias ...
//                     as: "Categories",
//                     // ... és ezeket a mezőit kérje le:
//                     attributes: ["id", "name"],
        
//                     // Ez pedig azért kell, hogy a kapcsolótáblát ne szemetelje bele,
//                     // a legjobb ha kikommentezed az alábbi sort és megnézed, mi változik
//                     through: { attributes: [] },
//                 },
//             ],
//         })
//     )
// });

// GET /categories //mind lekérése

fastify.get('/categories', async (request, reply) => {
    reply.send(await Category.findAll());
});


// GET /categories/:id //egy lekérése

fastify.get('/categories/:id', {
    schema: {
        params: {
            type: 'object',
            properties: {
                id: { type: 'number' }
            }
        }
    }
}, async (request, reply) => {
    const category = await Category.findByPk(request.params.id);
    if(category == null) {
        return reply.status(404).send(
            {
                message: "There is no category with the given ID - ".concat(request.params.id),
            }
        );
    }
    reply.send(category);
});

// POST /categories //kategória létrehozása

fastify.post('/categories', {
    schema: {
        body: {
            type: 'object',
            required: ['name','color'],
            properties: {
                name: { type: 'string' },
                color: { type: 'string', pattern: "^#[0-9a-fA-F]{6}$" },
            }
        }
    }
}, async (request, reply) => {
    const { name, color } = request.body;
    const category = await Category.create({ name,color });
    reply.send(category);
});

// PUT /categories/:id //módosítás

fastify.put('/categories/:id', {
    schema: {
        body: {
            type: 'object',
            required: ['name','color'],
            properties: {
                name: { type: 'string' },
                color: { type: 'string', pattern: "^#[0-9a-fA-F]{6}$" },
            }
        },
        params: {
            type: 'object',
            properties: {
                id: { type: 'number' }
            }
        }
    }
}, async (request, reply) => {

    const category = await Category.findByPk(request.params.id);

    if(category == null) {
        return reply.status(404).send(
            {
                message: "There is no category with the given ID - ".concat(request.params.id),
            }
        );
    }

    const { name, color } = request.body;
    await category.update({ name,color });
    reply.send(category);
});


// PATCH /categories/:id //módosítás

fastify.patch('/categories/:id', {
    schema: {
        body: {
            type: 'object',
            properties: {
                name: { type: 'string' },
                color: { type: 'string', pattern: "^#[0-9a-fA-F]{6}$" },
            }
        },
        params: {
            type: 'object',
            properties: {
                id: { type: 'number' }
            }
        }
    }
}, async (request, reply) => {

    const category = await Category.findByPk(request.params.id);

    if(category == null) {
        return reply.status(404).send(
            {
                message: "There is no category with the given ID - ".concat(request.params.id),
            }
        );
    }

    const { name, color } = request.body;
    await category.update({ name,color });
    reply.send(category);
});

// DELETE /categories //mind törélése

fastify.delete('/categories', async (request, reply) => {
    await Category.destroy({
        where: {}
    });
    reply.send(204);
});


// DELETE /categories/:id //egy törlése

fastify.delete('/categories/:id', {
    schema: {
        params: {
            type: 'object',
            properties: {
                id: { type: 'number' }
            }
        }
    }
}, async (request, reply) => {
    const category = await Category.findByPk(request.params.id);
    if(category == null) {
        return reply.status(404).send(
            {
                message: "There is no category with the given ID - ".concat(request.params.id),
            }
        );
    }
    await Category.destroy({
        where: {id: request.params.id}
    });
    reply.send(204);
});


// fastify.get('/categories/:id', {
//     schema: {
//         params: {
//             type: 'object',
//             properties: {
//                 id: { type: 'number' }
//             }
//         }
//     }
// }, async (request, reply) => {
//     const category = await Category.findByPk(request.params.id);
//     if(category == null) {
//         return reply.status(404).send(
//             {
//                 message: "There is no category with the given ID - ".concat(request.params.id),
//             }
//         );
//     }
//     reply.send(category);
// });

// Run the server!
fastify.listen({ port: 3000 }, (err, address) => {
    if (err) throw err
    // Server is now listening on ${address}
})