module.exports = {
    method: 'GET',
    path: '/',

    handler: async (request, h) => {

        return {'message': "hello"}


    }
}