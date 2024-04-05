function capitalizeFirstLetter(string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
}
async function fetchData() {
    document.getElementById('name').innerHTML = "Fetching Data..."
    await fetch('http://10.0.15.21/lab/lab5/person.json', {mode: 'no-cors'}).then(async res => {
        let data = await res.json()
        data = data[0]
        const pTag = document.createElement('p')
        document.getElementById('name').innerHTML = `<b>${data.firstName} ${data.lastName}</b>`
        document.getElementById('gender-age').innerHTML = `${data.age} Year Old, ${capitalizeFirstLetter(data.gender.type)} `
        document.getElementById('address').innerHTML = `${data.address.streetAddress} ${data.address.city}, ${data.address.state} ${data.address.postalCode}`
        for (let i = 0; i < 2; i++) {
            document.getElementById('phoneNumber').innerHTML += `&nbsp&nbsp&nbsp${capitalizeFirstLetter(data.phoneNumber[i].type)} ${data.phoneNumber[i].number}<br />`
        }
    }).catch(err => {
        document.getElementById('name').innerHTML = "<span style='color: red;'>Unable to fetch data</span>"
        document.getElementById('gender-age').innerHTML = err
    })
}
fetchData()