<template>
<div id="listaExpedients">


</div>


</template>

<script>

export default {
  name: 'expedients',

  data() {
    
  return {
    llistaExpedients:[1,2,3],
    expedientsSelecionats: [1]
  };
},
  mounted() {
    console.warn("carga?");
    this.CrearExpedient("lolazo");
  },
  methods: {
    LlamarALaApiPaPillarLosExpedientes()
    {

    },
    CrearExpedient(Expedient, key)
    {
      //
      let BaseCard = document.createElement("card"); //<div class="card" style="width: 18rem;">
      BaseCard.setAttribute("class","card");
      BaseCard.style.width = "18rem";
      let CardBody = document.createElement("div"); //<div class="card-body">
      CardBody.setAttribute("class","card-body");
        
      let CodiExpedient = document.createElement("h5"); //<h5 class="card-title">Codi Expedient</h5>
      CodiExpedient.setAttribute("class","card-title");
      CodiExpedient.innerText = "Nº NAE23124"; //HARCODEADO
        
      let DataExpedient = document.createElement("h6"); //<h6 class="card-subtitle mb-2 text-muted"></h6>
      DataExpedient.setAttribute("class","card-subtitle mb-2 text-muted");
      DataExpedient.innerText = "Telefon:";

      let LDataExpedient = document.createElement("p"); //<p class="card-text">10/11/2023 13:23:12 </p>
      LDataExpedient.setAttribute("class","card-text");
      LDataExpedient.innerText = "+34 634 323 324" //HARCODEADO

      let EstatExpedient = document.createElement("h6"); //<h6 class="card-subtitle mb-2 text-muted">Estat:</h6>
      EstatExpedient.setAttribute("class","card-subtitle mb-2 text-muted");
      EstatExpedient.innerText = "Nº Registres Carta Trucada:";

      let LEstatExpedient = document.createElement("p"); // <p class="card-text">Actiu</p>
      LEstatExpedient.setAttribute("class","card-text");
      LEstatExpedient.innerText = "2" //HARCODEADO

      let ForaDeCat = document.createElement("h6"); //<h6 class="card-subtitle mb-2 text-muted">Fora de Catalunya:</h6>
      ForaDeCat.setAttribute("class","card-subtitle mb-2 text-muted");
      ForaDeCat.innerText = "Incident";

      let LForaDeCat = document.createElement("p"); //<p class="card-text">No</p>
      LForaDeCat.setAttribute("class","card-text");
      LForaDeCat.innerText = "RECONEIXEMENT D'OLORS SOSPITOSES EN ESPAI EXTERIOR"; //HARCODEADO

      let Tipificacio = document.createElement("h6"); //<h6 class="card-subtitle mb-2 text-muted">Tipificacio:</h6>
      Tipificacio.setAttribute("class","card-subtitle mb-2 text-muted");
      Tipificacio.innerText = "Municipi:";

      let LTipificacio = document.createElement("p"); //<p class="card-text">GU NGI NGA</p>
      LTipificacio.setAttribute("class","card-text");
      LTipificacio.innerText = "Gelida";

      let boton = document.createElement("a"); //<a href="#" class="btn btn-primary">Go somewhere</a>
      boton.setAttribute("class","btn btn-primary");
      boton.innerText = "Selecionar";

      let tmp= this;

      boton.addEventListener("click", function()
      {
      let index = tmp.expedientsSelecionats.indexOf(key);
      console.log("indice: "+index);
      if(index !== -1)
      {                    
        BaseCard.style.backgroundColor = "white";
        tmp.expedientsSelecionats.splice(index, 1);
        boton.innerText = "Seleccionar";
      }
      else{
        BaseCard.style.backgroundColor = "#F5FBDD";
        tmp.expedientsSelecionats.push(key);
        boton.innerText = "Deseleccionar ";
        
      }
                
            });
            //Establecer Listener para Guardar el expediente Selecionado en el array
            
     CardBody.append(CodiExpedient);
     CardBody.append(DataExpedient);
     CardBody.append(LDataExpedient);
     CardBody.append(EstatExpedient);
     CardBody.append(LEstatExpedient);
     CardBody.append(ForaDeCat);
     CardBody.append(LForaDeCat);
     CardBody.append(Tipificacio);
     CardBody.append(LTipificacio);
     CardBody.append(boton);
            
     BaseCard.append(CardBody);
    
     document.getElementById("listaExpedients").append(BaseCard);



      //
    },
    CrearExpedients(Expedient)
    {
        
        this.llistaExpedients.forEach(function(value,key) {
          CrearExpedient(value, key)    
        });
        
    }  
    },
};
</script>