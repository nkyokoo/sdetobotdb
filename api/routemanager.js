const fs = require('fs')
const Path = require('path')
let routes = []

function readDirR(dir) {
    return fs.statSync(dir).isDirectory()
        ? Array.prototype.concat(
            ...fs.readdirSync(dir).map(f => readDirR(Path.join(dir, f)))
        )
        : dir
}

const routePaths = readDirR(Path.join(__dirname, '/routes/'))

routePaths.forEach(files => (routes = routes.concat(require(files))))
module.exports = routes