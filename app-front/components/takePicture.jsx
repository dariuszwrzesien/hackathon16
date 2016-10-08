import React from 'react';

const TakePicture = React.createClass({
  propTypes: {
    clearPicture: React.PropTypes.func.isRequired,
    newPictureTaken: React.PropTypes.func.isRequired
  },

  getInitialState () {
    return {
      imageUrl : '',
      fileName: '',
      displayImage: URL.createObjectURL
    };
  },

  getPicture (event) {
    if (!event.target.files.length) {
      this.props.clearPicture();
      this.setState({imageUrl: ''});
      return;
    }

    const file = event.target.files[0];
    this.props.newPictureTaken(file);
    this.setState({
      imageUrl: URL.createObjectURL(file),
      fileName: file.name
    });
  },

  render () {
    return (
      <div>
        <label htmlFor="takePicture">{this.state.imageUrl.length ? 'Zmień obrazek' : 'Dołącz obrazek'}{!this.state.displayImage ? this.state.fileName : ''}</label>
        <input
          accept="image/*"
          id="takePicture"
          name="picture"
          onChange={this.getPicture}
          style={{display: 'none'}}
          type="file"
        />
        { this.state.displayImage ? <img src={this.state.imageUrl} style={{maxHeight: '200px'}} /> : null }
      </div>
    );
  }
});

export default TakePicture;
