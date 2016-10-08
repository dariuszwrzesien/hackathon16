import config from '../config.json';

export default {
    getCoords (address) {
        return new Promise((resolve, reject) => {
            fetch(`https://maps.googleapis.com/maps/api/geocode/json?address=${encodeURIComponent(address)}&key=${config.googleApiKey}`)
                .then(response => response.json())
                .then(json => {
                    if (!json.results.length) {
                        throw new Error('nothing found');
                    }

                    const {lat, lng} = json.results[0].geometry.location;
                    resolve({latitude: lat, longitude: lng});
                }).catch(ex => {
                    reject(ex);
                });
        });
    }
};
