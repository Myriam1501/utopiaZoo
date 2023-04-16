window.onload = () => {
    let stripe= Stripe('pk_test_51Mco2mCmQpXm4b5YOxwLUTyQfxPAUAHrjQ4CJtZTQ9lokpukRvnYYjTMUG2yrQiLDkJ5MRaYBMapFclOZh4eY4oQ00bPnYP4YJ');
    let elements=stripe.elements();
    let cardHolderName = document.getElementById("cardholder-name");
    let cardButton=document.getElementById("card-button");
    let clientSecret=cardButton.dataset.secret;


    let card=elements.create("card");
    card.mount("#card-elements");


    card.addEventListener("change", (event) => {
        let displayError = document.getElementById("card-errors");
        if(event.error){
            displayError.textContent = event.error.message;
        }else{
            displayError.textContent = "";
        }
    })


    cardButton.addEventListener("click", () => {
        stripe.handleCardPayment(
            clientSecret,card, {
                payment_method_data: {
                    billing_details: {name: cardHolderName.value}
                }
            }
        ).then(result => {
            if(result.errors){
                document.getElementById("errors").innerText=result.error.message
            }else{
                document.location.href="{{ path('app_payment_pdf', {name: app.user.name, prenom: app.user.firstname, date:'23-02-2023'}) }}";
            }
        })
    })
}