<template>
    <div class="container main-container">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-3">
                            <h6>Codi de la trucada</h6>
                            <p>{{ datos.codiTrucada }}</p>
                        </div>
                        <div class="col-md-3">
                            <h6>Inici de la trucada</h6>
                            <p>{{ fechaHoraActual }}</p>
                        </div>
                        <div class="col-md-3">
                            <h6>Duració trucada</h6>
                            <p>{{ contadorFormatejat }}</p>
                        </div>
                        <div class="col-md-3">
                            <button class="btn btn-warning" @click="enviarDatos">Finalitzar Trucada</button>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <nav class="navbar navbar-expand-lg navbar-light bg-light ">
            <div class="container-fluid">
                <div class="collapse navbar-collapse">
                    <ul class="navbar-nav">
                        <li class="nav-item me-2">
                            <a class="nav-link" href="#identificacio_trucada">Identificació de la Trucada</a>
                        </li>
                        <li class="nav-item me-2">
                            <a class="nav-link" href="#nota_comuna">Nota Comuna</a>
                        </li>
                        <li class="nav-item me-2">
                            <a class="nav-link" href="#localitzacio_emergencia">Localització emergència</a>
                        </li>
                        <li class="nav-item me-2">
                            <a class="nav-link" href="#tipificacio_emergencia">Tipificació emergència</a>
                        </li>
                        <li class="nav-item me-2">
                            <a class="nav-link" href="#agencies">Agències</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>



        <div class="container mt-3 ">
            <div class="row">
                <div class="col-md-8 content-container">
                    <form>
                        <section id="identificacio_trucada">
                            <h2>Identificació de la Trucada</h2>

                            <div class="mb-3">
                                <input type="tel" class="form-control" name="numTel" id="numTel" placeholder="Nº Telèfon"
                                    required autofocus v-model="datos.numTel">
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <input type="text" class="form-control" name="Nom" id="Nom" placeholder="Nom" required
                                        v-model="datos.nom">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <input type="text" class="form-control" name="Cognom" id="Cognom" placeholder="Cognom"
                                        required v-model="datos.cognom">
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-md-12">
                                    <input type="text" class="form-control" name="Antecedents" id="Antecedents"
                                        placeholder="Antecedents del telèfon" required v-model="datos.antecedents">
                                </div>
                            </div>
                        </section>


                        <section class="mt-2" id="nota_comuna">
                            <h2>Nota Comuna</h2>
                            <div class="form-group">
                                <textarea class="form-control" rows="7" name="descripcion"
                                    placeholder="Nom y cognom del trucant, relació de l’alertant amb l’incident, telefon de contacte, descripcio del fet."
                                    required v-model="datos.notacomuna"></textarea>
                            </div>
                        </section>

                        <section class="mt-3" id="localitzacio_emergencia">
                            <h2>Localització emergència</h2>

                            <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" value="" id="foraDeCatalunya"
                                    @change="toggleForaDeCatalunya">
                                <label class="form-check-label" for="foraDeCatalunya">
                                    Fora de Catalunya
                                </label>
                            </div>

                            <div class="row" v-if="!foraDeCatalunya">

                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <select class="form-select" v-model="selectedProvincia" @change="fetchComarques"
                                            required>
                                            <option v-if="carregant" value="" disabled selected>Cargando...</option>
                                            <option v-else value="" disabled selected>Provincia</option>
                                            <option v-for="provincia in provincies" :key="provincia.id"
                                                :value="provincia.id">
                                                {{ provincia.nom }}
                                            </option>
                                        </select>
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <select class="form-select" v-model="selectedComarca" @change="fetchMunicipis"
                                            :disabled="!selectedProvincia" required>
                                            <option value="" disabled selected>Comarca</option>
                                            <option v-for="comarca in comarques" :key="comarca.id" :value="comarca.id">
                                                {{ comarca.nom }}
                                            </option>
                                        </select>
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <select class="form-select" v-model="datos.selectedMunicipi"
                                            :disabled="!selectedComarca" required>
                                            <option value="" disabled selected>Municipi</option>
                                            <option v-for="municipi in municipis" :key="municipi.id" :value="municipi.id">
                                                {{ municipi.nom }}
                                            </option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12 mb-3">
                                        <select class="form-select" name="tipusLocalitzacio" required
                                            v-model="datos.tipusLocali">
                                            <option value="" disabled selected>Tipus de localització</option>
                                            <option v-for="tipus in tipusLocalitzacions" :key="tipus.id" :value="tipus.id">
                                                {{ tipus.nom }}
                                            </option>
                                        </select>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <input type="text" class="form-control" name="adreça" id="adreça"
                                            placeholder="Adreça" required v-model="datos.adresa">
                                    </div>
                                </div>

                            </div>

                            <div v-else>
                                <div class="row">
                                    <div class="col-12 mb-3">
                                        <input type="text" class="form-control" name="municipiInter" id="municipiInter"
                                            placeholder="Municipi" required v-model="datos.descripcio">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12 mb-3">
                                        <select class="form-select" name="tipusLocalitzacio" required
                                            v-model="datos.tipusLocali">
                                            <option value="" disabled selected>Tipus de localització</option>
                                            <option v-for="tipus in tipusLocalitzacions" :key="tipus.id" :value="tipus.id">
                                                {{ tipus.nom }}
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <textarea class="form-control" name="mesInformacio" id="mesInformacio"
                                        placeholder="Més informació sobre la localització"
                                        v-model="datos.detalls"></textarea>
                                </div>
                            </div>
                        </section>


                        <section class="mt-2" id="tipificacio_emergencia">
                            <h2>Tipificació emergència</h2>

                            <div class="row">
                                <div class="col">
                                    <select class="form-select" name="tipus_incident" required
                                        v-model="datos.tipus_incident">
                                        <option value="" disabled v-bind:selected="!datos.tipus_incident">Tipus d'incident
                                        </option>
                                        <option v-for="tipus in tipus_incidents" :key="tipus.id" :value="tipus.id">
                                            {{ tipus.nom }}
                                        </option>
                                    </select>

                                </div>
                                <div class="col">
                                    <select class="form-select" name="incident" required v-model="datos.incident">
                                        <option value="" disabled selected>Incident</option>
                                        <option v-for="incident in incidents" :key="incident.id" :value="incident.id">
                                            {{ incident.nom }}
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <p class="mt-3">INCIDENT SELECCIONAT: <span>{{ incidentSeleccionat.nom || 'N/A' }}</span></p>
                            <p>DEFINICIÓ INCIDENT: <span>{{ incidentSeleccionat.definicio || 'N/A' }}</span></p>
                            <p>INSTRUCCIONS INCIDENT: {{ incidentSeleccionat.instruccions || 'Aquí les instruccions' }}</p>
                        </section>


                        <section class="mt-2" id="agencies">
                            <h2>Agències</h2>
                            <mapa ref="mapaComponente"></mapa>
                        </section>

                    </form>

                </div>
                <div class="col-md-3 content-container">
                    <p>
                        <llistaExp>
                            
                        </llistaExp>
                    </p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Mapa from './MapaAgencies.vue'
import llistaExp from './SelecionarExpedients.vue'
export default {    
    components:
    {
    Mapa,
    llistaExp
    },
    data() {
        return {
            foraDeCatalunya: false,
            provincies: [],
            comarques: [],
            municipis: [],
            tipusLocalitzacions: [],

            tipus_incidents: [],
            incidents: [],
            incidentSeleccionat: {},

            selectedProvincia: "",
            selectedComarca: "",


            carregant: true,

            fechaHoraActual: "",
            contador: 0,
            interval: null,

            datos: {
                codiTrucada: this.generarCodiTrucada(),
                iniciTrucada: "",
                duracioTrucada: 0,

                numTel: "",
                nom: "",
                cognom: "",
                antecedents: "",
                notacomuna: "",
                tipusLocali: "",
                adresa: "",
                descripcio: "",
                detalls: "",
                incident: "",
                tipus_incident: "",
                expedient: 1,
                usuari: window.userId,
                interlocutorID: "",
                selectedMunicipi: "",
                selectedProvincia: 1,
                selectedAgencias: []
            },

        };
    },
    
    created() {

    },
    mounted() {
        this.setFechaHoraActual();
        this.iniciarContador();
        this.fetchProvincies();
        this.fetchTipusIncidents();
        this.carregaTipusLocalitzacions(); 
        this.SetearListenerDireccion();       
    },
    beforeDestroy() {
        clearInterval(this.interval);
    },
    computed: {
        contadorFormatejat() {
            const minutos = Math.floor(this.contador / 60);
            const segundos = this.contador % 60;
            return `${minutos.toString().padStart(2, '0')}:${segundos.toString().padStart(2, '0')}`;
        },
    },
    watch: {
        'datos.tipus_incident': function (newVal) {
            if (newVal) {
                this.fetchIncidents(newVal);
                this.incidentSeleccionat = {};
            } else {
                this.incidents = [];
            }
        },
        'datos.incident': function (newVal) {
            this.incidentSeleccionat = this.incidents.find(incident => incident.id == newVal) || {};
        }
    },
    methods: {
        toggleForaDeCatalunya() {
            this.foraDeCatalunya = !this.foraDeCatalunya;
        },
        CargarContenidoMapa()
        {
            //Obtener contenido de el input de direccion
            let contenido = document.getElementById("adreça").value;
            this.$refs.mapaComponente.llenarFormularioBusqueda(contenido);
        },
        SetearListenerDireccion()
        {
            let timer,
		timeoutVal = 1000; // time it takes to wait for user to stop typing in ms

        const typer = document.getElementById('adreça');

        typer.addEventListener('keypress', handleKeyPress);
        typer.addEventListener('keyup', handleKeyUp);

        // when user is pressing down on keys, clear the timeout
        function handleKeyPress(e) {
            window.clearTimeout(timer);
            console.log("tipping");
        }

        // when the user has stopped pressing on keys, set the timeout
        // if the user presses on keys before the timeout is reached, then this timeout is canceled
        let temp = this;
        function handleKeyUp(e) {
            window.clearTimeout(timer); // prevent errant multiple timeouts from being generated
            timer = window.setTimeout(() => {
            temp.CargarContenidoMapa();
        }, timeoutVal);
        }

        },
        fetchProvincies() {
            axios
                .get("/api/provincies")
                .then((response) => {
                    this.provincies = response.data;
                    this.carregant = false;
                })
                .catch((error) => {
                    console.error(error);
                });
        },
        fetchComarques() {
            axios
                .get(`/api/provincies/${this.selectedProvincia}/comarques`)
                .then((response) => {
                    this.comarques = response.data;
                    this.selectedComarca = "";
                    this.municipis = [];
                })
                .catch((error) => {
                    console.error(error);
                });
        },
        fetchMunicipis() {
            axios
                .get(`/api/comarques/${this.selectedComarca}/municipis`)
                .then((response) => {
                    this.municipis = response.data;
                })
                .catch((error) => {
                    console.error(error);
                });
        },
        async fetchTipusIncidents() {
            const response = await axios.get('/api/tipus_incidents');
            this.tipus_incidents = response.data;
        },
        async fetchIncidents(tipus_incidents_id) {
            const response = await axios.get(`/api/tipus_incidents/${tipus_incidents_id}/incidents`);
            this.incidents = response.data;
        },
        carregaTipusLocalitzacions() {
            axios.get('/api/tipus-localitzacions')
                .then(response => {
                    this.tipusLocalitzacions = response.data;
                })
                .catch(error => {
                    console.error('Error carregant tipus de localitzacions:', error);
                });
        },
        setFechaHoraActual() {
            this.fechaHoraActual = new Date().toLocaleString('es-ES');
        },
        iniciarContador() {
            this.interval = setInterval(() => {
                this.contador++;
            }, 1000);
        },

        enviarDatos() {
            this.datos.selectedAgencias =  this.$refs.mapaComponente.selectedAgencies;
            this.datos.duracioTrucada = this.convertirTiempoASegundos(this.contadorFormatejat);
            this.datos.iniciTrucada = new Date().toISOString();
            //this.datos.selectedAgencias = arrayque itng;

            console.log('Datos del objeto:', this.datos);

            axios
                .post("/api/cartes-trucades", this.datos)
                .then((response) => {
                    console.log(response.data.message);
                    location.reload();
                })
                .catch((error) => {
                    if (error.response) {
                        console.error('Error al guardar los datos:', error.response.data.message, 'Código de error:', error.response.data.code);
                    } else {
                        console.error('Error al guardar los datos:', error.message);
                    }
                });
        },

        convertirTiempoASegundos(tiempoFormateado) {
            const [minutos, segundos] = tiempoFormateado.split(':');
            return parseInt(minutos) * 60 + parseInt(segundos);
        },


        generarCodiTrucada() {
            const timestamp = new Date().getTime();
            return `CA-${timestamp}`;
        },
    },
};
</script>


<style>
.main-container {
    margin-top: 20px;
    margin-bottom: 20px;
}

.content-container {
    height: calc(77vh - 100px);
    overflow-y: scroll;
}
</style>
