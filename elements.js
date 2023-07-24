class BiometricsHandler extends HTMLBaseElement {
    constructor(){
        super();
        this._customPropValue = false;
    }
    click = () => {
        this.setAttribute('addFingerPrint', 'fingerprint');
    }

    fingerprint = () => {

    }

    face = () => {

    }
}

customElements.define('biometrics-fingerprint', BiometricsHandler)
