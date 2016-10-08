import React from 'react';

export default ({status}) => {
  const alert = ({alertType, message}) => (
    <div className={`alert ${alertType}`} role="alert">
        <p>{message}</p>
    </div>
  );

  if (status.uploaded) {
    return alert({alertType: 'alert-success', message: 'Obrazek został wysłany na serwer i dołączony do Twojego zgłoszenia!'});
  }
  
  if (status.error) {
    return alert({alertType: 'alert-danger', message: `Wystąpił błąd podczas wysyłania obrazka`});
  }

  if (status.uploading) {
    return alert({alertType: 'alert-info', message: 'Obrazek jest dołączany do Twojego zgłsozenia'});
  }

  return null;
};
