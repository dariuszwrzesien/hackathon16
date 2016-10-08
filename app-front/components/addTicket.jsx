import React from 'react';

import ProgressList from './progressList';
import GMap from './gMap';

const AddTicket = React.createClass({
    getInitialState () {
        return {
            categories: [],
            panel: 0,
            stepCount: 5,
            error: null,
            coordinates: {},
            category: 1,
            description: '',
            locationAddress: '',
            notifierName: '',
            notifierEmail: '',
            notifierPhone: ''
        };
    },

    componentWillMount () {
        $.ajax({
            url: '/api/categories',
            success: result => {
                this.setState({
                    categories: result
                });
            }
        });
    },

    addTicket () {
        const {latitude, longitude} = this.state.coordinates;
        const newTicket = {
            latitude,
            longitude,
            description: this.state.description,
            category: this.state.category,
            notifier_name: this.state.notifierName,
            notifier_email: this.state.notifierEmail,
            notifier_phone: this.state.notifierPhone
        };

        $.ajax({
            method: 'POST',
            url: '/api/tickets',
            data: newTicket,
            success: () => this.showPanel(5),
            error: (jqhxr, error, message) => this.setState({error: message})
        });
    },

    renderCategories () {
        var buffer = [];
            for (var i = 0; i < this.state.categories.length; i++ ) {
                var html = <option key={this.state.categories[i].id} value={this.state.categories[i].id}>{this.state.categories[i].name}</option>;
                buffer.push(html);
            }
        return buffer;
    },

    toggleMap () {
        this.setState(oldState => {
            return {
                toggleMap: !oldState.toggleMap
            };
        });
    },

    showPanel (panel) {
        this.setState({panel});
    },

    renderPanel (panel) {
        if (this.state.error) {
            return null;
        }

        const panels = [
            () => <div className="panel">
                <h2>Start</h2>
                <div className="box thin-box">
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Deserunt harum, cupiditate ipsum, excepturi at alias explicabo sapiente repudiandae, recusandae eligendi sequi assumenda fugiat ratione consequuntur aliquam inventore! Saepe, doloribus, aut.</p>
                    <button
                        className="button button-red navigate arrow arrow-next button-center"
                        onClick={this.showPanel.bind(null, 1)}
                        type="button"
                    >Rozpocznij</button>
                </div>
            </div>,
            () => {
                const setLocationAddress = (event) => this.setState({
                    locationAddress: event.target.value
                });

                return (
                    <div className="panel">
                        <h2>Lokalizacja</h2>
                        <div className="box">
                            <ProgressList
                                progress={1}
                                steps={this.state.stepCount}
                            />
                            <p>Lorem ipsum Deserunt harum, cupiditate ipsum, excepturi at alias explicabo sapiente repudiandae, recusandae eligendi sequi assumenda fugiat ratione consequuntur aliquam inventore! Saepe, doloribus, aut.</p>
                            <input
                                className="form-control"
                                onChange={setLocationAddress}
                                placeholder="Lokalizacja"
                                type="text"
                                value={this.state.locationAddress}
                            />
                            <div className="row">
                                <div className="col-sm-offset-6 col-sm-6">
                                    <button
                                        className="button button-gray navigate arrow arrow-next"
                                        onClick={this.showPanel.bind(null, 2)}
                                        type="button"
                                    >Dalej</button>
                                </div>
                            </div>
                        </div>
                    </div>
                );
            },
            () => {
                const setCoordinates = coordinates => this.setState({
                    coordinates
                });

                return (<div className="panel">
                    <h2>Mapa</h2>
                    <div className="box">
                        <ProgressList
                            progress={2}
                            steps={this.state.stepCount}
                        />
                        <GMap
                            address={this.state.locationAddress}
                            setCoordinates={setCoordinates}
                            style={{width: '100%', height: '300px'}}
                        />
                        <div className="row">
                            <div className="col-sm-6">
                                <button
                                    className="button button-gray navigate arrow arrow-prev"
                                    onClick={this.showPanel.bind(null, 1)}
                                    type="button"
                                >Wstecz</button>
                            </div>
                            <div className="col-sm-6">
                                <button
                                    className="button button-gray navigate arrow arrow-next"
                                    onClick={this.showPanel.bind(null, 3)}
                                    type="button"
                                >Dalej</button>
                            </div>
                        </div>
                    </div>
                </div>);
            },
            () => {
                const setDescription = (event) => this.setState({
                    description: event.target.value
                });

                const setCategory = (event) => this.setState({
                    category: Number(event.target.value)
                });

                return (<div className="panel">
                    <h2>Opisz zgłoszenie</h2>
                    <div className="box">
                        <ProgressList
                            progress={3}
                            steps={this.state.stepCount}
                        />
                        <p>Opisz zgłoszenie</p>
                        <textarea
                            className="form-control"
                            placeholder="Opis"
                            onChange={setDescription}
                        >{this.state.description}</textarea>
                        <select
                            className="form-control"
                            onChange={setCategory}
                            value={this.state.category}
                        >
                            {this.renderCategories()}
                        </select>
                        <div className="row">
                            <div className="col-sm-6">
                                <button
                                    className="button button-gray navigate arrow arrow-prev"
                                    onClick={this.showPanel.bind(null, 2)}
                                    type="button"
                                >Wstecz
                                </button>
                            </div>
                            <div className="col-sm-6">
                                <button
                                    className="button button-gray navigate arrow arrow-next"
                                    onClick={this.showPanel.bind(null, 4)}
                                    type="button"
                                >Dalej
                                </button>
                            </div>
                        </div>
                    </div>
                </div>);
            },
            () => {
                const setNotifierName = (event) => this.setState({
                    notifierName: event.target.value
                });

                const setNotifierEmail = (event) => this.setState({
                    notifierEmail: event.target.value
                });

                const setNotifierPhone = (event) => this.setState({
                    notifierPhone: event.target.value
                });

                return (<div className="panel">
                    <h2>Dane zgłaszającego</h2>
                    <div className="box">
                        <ProgressList
                            progress={4}
                            steps={this.state.stepCount}
                        />
                        <p>Imię i nazwisko</p>
                        <input
                            className="form-control"
                            onChange={setNotifierName}
                            type="text"
                            value={this.state.notifierName}
                        />
                        <p>Adres e-mail</p>
                        <input
                            className="form-control"
                            onChange={setNotifierEmail}
                            type="email"
                            value={this.state.notifierEmail}
                        />
                        <p>Numer telefonu</p>
                        <input
                            className="form-control"
                            onChange={setNotifierPhone}
                            type="email"
                            value={this.state.notifierPhone}
                        />
                        <div className="row">
                            <div className="col-sm-6">
                                <button
                                    className="button button-gray navigate arrow arrow-prev"
                                    onClick={this.showPanel.bind(null, 3)}
                                    type="button"
                                >Wstecz
                                </button>
                            </div>
                            <div className="col-sm-6">
                                <button
                                    className="button button-red navigate arrow arrow-next"
                                    onClick={this.addTicket}
                                    type="button"
                                >Zakończ
                                </button>
                            </div>
                        </div>
                    </div>
                </div>);
            },
            () => <div className="panel">
                <h2>Zgłoszenie zostało wysłane</h2>
                <div className="box thin-box">
                    <ProgressList
                        progress={5}
                        steps={this.state.stepCount}
                    />
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Deserunt harum, cupiditate ipsum, excepturi at alias explicabo sapiente repudiandae, recusandae eligendi sequi assumenda fugiat ratione consequuntur aliquam inventore! Saepe, doloribus, aut.</p>
                    <button
                        className="button button-red navigate button-center"
                        onClick={this.reset}
                        type="button"
                    >Powrót na stronę główną</button>
                </div>
            </div>
        ];

        if (this.state.panel !== panel) {
            return null;
        }

        return panels[panel]();
    },

    reset () {
        this.setState(Object.assign({}, this.getInitialState(), {categories: this.state.categories}));
    },

    renderError () {
        if (!this.state.error) {
            return null;
        }

        return <div className="alert alert-danger">Due to an error we could not save your ticket. Please, <a onClick={this.reset} style={{cursor: 'pointer'}}><strong>try again</strong></a> in a second.</div>;
    },

    render () {
        return (<section>
            <div className="container">
                <div className="row">
                    <div className="col-md-10 col-md-offset-1">
                        <form action="#">
                            <div className="panel-container">
                                {this.renderError()}
                                {this.renderPanel(0)}
                                {this.renderPanel(1)}
                                {this.renderPanel(2)}
                                {this.renderPanel(3)}
                                {this.renderPanel(4)}
                                {this.renderPanel(5)}
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>);
    }
});

export default AddTicket;
