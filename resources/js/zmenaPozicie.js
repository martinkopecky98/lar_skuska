function zmena_pozicie()
{
    console.log("zmenaaa pozicieee");
    axios
    .get('http://localhost:8080/lar_skuska/public/users/ZmenaPozicie')
    .then(function (response) {
            console.log(response.data);
        })
    .catch(function (error) {
        console.log(error);
    })
}

document.getElementById('zmena_pozicie').addEventListener('click', zmena_pozicie);