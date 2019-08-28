module.exports = {
    method: 'GET',
    path: '/api',
    config: { auth: 'jwt'},
    handler: async (request, h) => {

        return {'message': "hello"}


    }
}