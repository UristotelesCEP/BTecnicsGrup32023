<template>
  <div class="map-container">
    <div class="botones-container">
      <button type="button" class="Ubt btn btn-primary btn-circle btn-sm" @click="irAlPunto()"><i class="bi bi-geo-fill"></i></button>  
      <button type="button" class="Ubt btn btn-primary btn-circle btn-sm" @click="pulsarBoton()"><i class="bi bi-geo-alt"></i></button>
      <!-- <button type="button" class="Ubt btn btn-primary btn-circle btn-sm" @click="BucarAgenciasCercanas()"><i class="bi bi-search"></i></button>       -->
    </div>    
      <form class="form Extras" id="extras">
        <div class="input-group has-validation">
          
          <input type="text" class="form-control" id="Busqueda">
          <span @click="BotonBuscar()" class="input-group-text"><i class="bi bi-search"></i></span>
        </div>        
        
        
        <select id="SMenu" v-on:change="CambiarElementoSelection()" class="form-select form-select-sm"></select>        
      </form>
  <div id="map"></div>
 
  </div>
  <div class="Selecionados">
		<h3>Agencias Seleccionadas</h3>
		<table class="table">
			<thead>
				<tr>
					<th>Nom</th>
					<th>Tipus</th>
					<th> </th>
				</tr>
			</thead>
      <tbody id="agenciasBody"> 
      
    </tbody>
		</table>
	</div>
</template>

<script>
import mapboxgl, { MapboxEvent, baseApiUrl } from 'mapbox-gl';
import MapboxGeocoder from '@mapbox/mapbox-gl-geocoder';


export default {
  name: 'Map',

  data() {
  return {
    map: null,
    PointPos: [],
    selectedAgencies: [],
    ApiResultList: [],
    Thepoint: null
  };
},
  mounted() {
    mapboxgl.accessToken = 'pk.eyJ1IjoidXJpc3RvdGVsZXMiLCJhIjoiY2xmczBid3Z6MDFodTNwb2JqazBjYTVtdCJ9.nx02VY3gB7guH1_rogEL7w';
    this.map = new mapboxgl.Map({
      container: 'map',
      style: 'mapbox://styles/uristoteles/clfthecy8000o01mvri3bf0wv', 
      center: [1.874201578508002, 41.665093514840294],      
      zoom: 7.3
    });
    
    this.DesaparecerElementos();
    this.map.on('click', (event) => {
      
      const features = this.map.queryRenderedFeatures(event.point, {
        layers: ['definitivav1']
      });
      if (!features.length) {
        return;
      }
      const feature = features[0];
      console.warn("query features:"+event.point);
      console.log(event.point);

      const popup = new mapboxgl.Popup({ offset: [0, -15] })
        .setLngLat(feature.geometry.coordinates)
        .setDOMContent(this.setPopu(feature))
        .addTo(this.map);
        
       
    });
  },
  methods: {
    setPopu(feature)
    {
      let Button = document.createElement('button');
      Button.setAttribute("type", "button");
      Button.setAttribute("class", "btn "+this.ColorAgencies(feature.properties.description));
      let temp = this;

      Button.addEventListener("click",function()
      {
        if(!temp.selectedAgencies.includes(feature.properties.id))
        {
          temp.selectedAgencies.push(feature.properties.id);
        temp.CrearElementoLista(feature.properties.id,feature.properties);
        }
        else{
          alert("Ya has Añadido esta Agencia :D no puedes añadir agencias repetidas");
        }
        
        // console.log(temp.selectedAgencies);
      });
      Button.innerText= "Seleccionar"
      let titulo = document.createElement('h5');
      titulo.innerText = feature.properties.title;
      
      let DescBaddget = document.createElement("span");
     
      DescBaddget.setAttribute("class","mb-2 badge rounded-pill "+ this.ColorAgencies(feature.properties.description));
      DescBaddget.innerText = feature.properties.description;

      let Base = document.createElement('div');
      Base.setAttribute("class","popu");
      Base.append(titulo);       
      Base.append(DescBaddget);
      
      Base.append(document.createElement("br"));
      
      Base.append(Button);          
            
      return Base;
    },
    ColorAgencies(elemento)
    {
      let ret = ""
        switch(elemento)
        {
          case "bombers":
          ret = "bg-warning"
          break;
          case "Bombers":
          ret = "bg-warning"
          break;
          case "Guardia Urbana":
          ret = "bg-primary"
          break;
          case "Policia Local":
          ret = "bg-primary"
          break;
          case "Policia Municipal":
          ret = "bg-primary"
          break;
          case "Mossos d'Esquadra":
          ret = "bg-primary"
          break;
          case "Policia de transit":
          ret = "bg-secondary"
          break;
          case "Atencio Ciutadana":
            ret= "bg-secondary";
          break;
        }
        return ret;
    },
    pulsarBoton() {
    var elemento = document.getElementById("extras");
    if (elemento.style.display === "none") 
    {
      elemento.style.display = "block";
    } 
    else 
    {
      elemento.style.display = "none";
    }
    },

    CambiarElementoSelection()
    {
      let valor = document.getElementById("SMenu").value;            
      this.BorrarPunto();
      let cord1 = this.ApiResultList[valor].center[0];
      let cord2 = this.ApiResultList[valor].center[1];
      this.PointPos = [cord1,cord2];
      this.MarcarPunto();
      this.irAlPunto();      
      //Cambiar Cordenadas this.punto
      //Llamar metodo
    },
    CrearElementoLista(id, feature)
    {
      const container = document.getElementById("agenciasBody");
      // Crear los elementos tr, td y button
      const tr = document.createElement("tr");
      tr.setAttribute("id","E"+id);
      const td1 = document.createElement("td");
      const td2 = document.createElement("td");
      const td3 = document.createElement("td");
      const button = document.createElement("button");

      // Agregar el contenido a los elementos td y button
      td1.innerText = feature.title;
      td2.innerText = feature.description;
      button.setAttribute("type", "button");
      button.setAttribute("class", "btn btn-danger");
      let temp = this;
      button.addEventListener("click", function() {
        temp.BorrarElemento(id);
      });
      button.innerHTML = '<i class="bi bi-trash"></i>';

      // Agregar los elementos a la estructura
      td3.appendChild(button);
      tr.appendChild(td1);
      tr.appendChild(td2);
      tr.appendChild(td3);
      container.appendChild(tr);
    },
    BorrarElemento(index)
    {
      this.selectedAgencies = this.eliminarValorFromArray(this.selectedAgencies, index);
      const elemento = document.getElementById("E"+index);
      console.log(elemento.remove());
    },
    DesaparecerElementos()
    {
      console.log("Entra?SS")
      document.getElementById("extras").style.display = "none";      
    },
    AparecerElementos()
    {
      document.getElementById("extras").style.display = "block";      
    },
   
    eliminarValorFromArray(array, valor) {
      
      const indice = array.indexOf(valor);
      if (indice === -1) {
        return array;
      }
      array.splice(indice, 1);
      return array;
    },
    irAlPunto() {
      this.map.flyTo({
        center: this.PointPos,
        zoom: 15,
        speed: 4,
        curve: 1,
        easing(t) {
          return t;
        }
      });
    },
    MarcarPunto() {            
    const el = document.createElement('div');
    el.className = 'marker';
    el.id = 'punto';
    let p = new mapboxgl.Marker(el).setLngLat(this.PointPos).addTo(this.map);
    this.Thepoint = p;

     console.warn("The point");
      console.log(p);
    },
    BorrarPunto() {
      let poin = document.getElementById("punto");
      if(poin)
      {
        poin.remove()
      }
    },
    BotonBuscar()
    {
      let sitioAbuscar = document.getElementById("Busqueda").value;
      this.BuscarPunto(sitioAbuscar);
    },
    
    async BuscarPunto(placeToFind)
    {
      const mapboxBaseUrl = 'https://api.mapbox.com';
      const mapboxEndpoint = '/geocoding/v5/mapbox.places';
      const mapboxQueryParams = '?country=es&limit=6&types=address&language=es';
      const mapboxAccessToken = 'pk.eyJ1IjoidXJpc3RvdGVsZXMiLCJhIjoiY2xmczBid3Z6MDFodTNwb2JqazBjYTVtdCJ9.nx02VY3gB7guH1_rogEL7w';
      //const placeToFind = 'Passeig de Sant Joan, '; // Cambiar este valor según tus necesidades

      const mapboxAPI = `${mapboxBaseUrl}${mapboxEndpoint}/${placeToFind}.json${mapboxQueryParams}&access_token=${mapboxAccessToken}`;

      fetch(mapboxAPI)
        .then(response => response.json())
        .then(data => {
          console.warn("data:");  
          console.log(data);
          this.ApiResultList = data.features;
          this.PointPos = this.GetCords(data);
          this.MarcarPunto();
          this.irAlPunto();
          this.CargarElementosSelection();
        })
        .catch(error => console.error("Error:"+error));
            
      },
      llenarFormularioBusqueda(Direccion)
      {
        let elemento = document.getElementById("Busqueda");
        elemento.value = Direccion;
        this.BotonBuscar();
      },
      CargarElementosSelection()
      {
        //Comprobar si ya tiene elementos
        // si tiene elementos borrar y añadir los nuevos
        let SelectDiv = document.getElementById("SMenu");

        if (SelectDiv.options.length > 0) {
        while (SelectDiv.options.length) {
          SelectDiv.remove(0);
        }
      }

        this.ApiResultList.forEach(function callback(valor,indice){          
          let op = document.createElement("option");
          op.value = indice;
          op.innerText = valor.place_name;
          if(indice === 0)
          {
            op.selected = true;
          }
          SelectDiv.append(op);  
        });
      },
      GetCords(respuestajson)
      {         
         let cord1 = respuestajson.features[0].center[1];
         let cord2 = respuestajson.features[0].center[0];
        return new Array(cord2,cord1);
            
      },
      BucarAgenciasCercanas()
      {
        console.warn("Entra?")        

              // Find all features within a bounding box around a point
      const width = 30000000;
      const height = 30000000;
      const features = this.map.queryRenderedFeatures([
      [this.test[0] - width / 2, this.test[1] - height / 2],
      [this.test[0] + width / 2, this.test[1] + height / 2]
      ], {layers: ['definitivav1']});
        const feature = features[0];
        console.warn("AGENCIAS");
        console.log(features);
      }
      

  },
};
</script>

<style scoped>
  

  .map-container {
    position: relative;   
    width: 100%;
    height: 100%;
    background-color: #eee;
  }
  #map { 
        position: relative;         
        width: 100%; 
        height: 500px;
      }      
.botones-container {
  position: absolute;
  top: 10px;
  z-index: 10;
  right: 10px;
  
}
.Extras{
  position: absolute;
  top: 50px;
  z-index: 10;
  right: 10px;
}
.Ubt
{
  margin: 2px;
}
.Selecionados
{
  margin-top: 10px;
  position: relative;
}


</style>