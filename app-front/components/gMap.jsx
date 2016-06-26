import React from 'react';

import {GoogleMapLoader, GoogleMap, Marker} from 'react-google-maps';
import {triggerEvent} from 'react-google-maps/lib/utils';

import googleMaps from '../services/googleMaps';

const Map = React.createClass({
    propTypes: {
        address: React.PropTypes.string.isRequired,
        setCoordinates: React.PropTypes.func,
        style: React.PropTypes.object
    },

    getInitialState () {
        return {
            ready: false,
            markers: []
        };
    },

    componentWillMount () {
        googleMaps.getCoords(this.props.address)
            .then(
                coords => {
                    const {longitude, latitude} = coords;
                    const googleMapsCoords = {lat: latitude, lng: longitude};
                    this.notifyAboutNewCoordinates(coords);
                    this.setState({
                        position: googleMapsCoords,
                        ready: true,
                        marker: {
                            position: googleMapsCoords,
                            key: this.props.address,
                            defaultAnimation: 2
                        }
                    });
                },
                rejection => this.setState({locationError: rejection, ready: false})
            );
    },

    notifyAboutNewCoordinates (coords) {
        if (!this.props.setCoordinates) {
            return;
        }

        this.props.setCoordinates(coords);
    },

    renderLoadingIndicator () {
        if (!this.state.ready) {
            return '...loading...';
        }

        return null;
    },

    renderError () {
        if (this.state.locationError) {
            return <p className="aler alert-error">{this.state.locationError}</p>;
        }

        return null;
    },

    handleMapClick (event) {
        this.setState({
            marker: {
                position: event.latLng,
                defaultAnimation: 2,
                key: Date.now()
            }
        });

        this.notifyAboutNewCoordinates({longitude: event.latLng.lng(), latitude: event.latLng.lat()});
    },

    renderMap () {
        if (!this.state.position) {
            return null;
        }

        return (
            <GoogleMapLoader
                containerElement={
                    <div
                        {...this.props}
                        style={{
                            height: '100%',
                            width: '100%'
                        }}
                    />
                }
                googleMapElement={
                    <GoogleMap
                        defaultCenter={this.state.position}
                        defaultZoom={15}
                        onClick={this.handleMapClick}
                        ref={map => (this._googleMapComponent = map)}
                    >
                        <Marker
                            {...this.state.marker}
                        />
                    </GoogleMap>
                }
            />
        );
    },

    render () {
        return (
            <div className="Map" style={this.props.style}>
                {this.renderLoadingIndicator()}
                {this.renderError()}
                {this.renderMap()}
            </div>
        );
    }
});

export default Map;
