const mbHelper = require('./moutbank-helper');
const settings = require('./settings');

const text = "Hello world!";

function addService() {
    const response = { text: text.replace(/l/g, '!') };
    const stubs = [
        {
            predicates: [ {
                equals: {
                    method: "POST",
                    "path": "/"
                },
            },
           ],
            responses: [
                {
                    is: {
                        body: JSON.stringify(response)
                    }

                }
            ],
        },
    ];
    const imposter = {
        port: settings.changeChartsPort,
        protocol: 'http',
        stubs: stubs
    };
    return mbHelper.postImposter(imposter);
}
module.exports = { addService };