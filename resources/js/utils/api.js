import axios from 'axios'

export function getCategories() {
 
  return axios.get('/api/categories');
            
}

export function getCategory(id){
    return axios.get('/api/categories/'+ id);
}

export function getHouses(){
    return axios.get('/api/houses');
}

export function getHouse(id){
    return axios.get('/api/house/'+ id);
}

export function getHouseCategory(id){
    return axios.get('/api/category/'+ id);
}

export function getLocations(){
    return axios.get('/api/locations');
}

export function getReservationsHouse(id){
    return axios.post('/api/reservation/allReservationHouse',{'house_id' : id});
}

export function getReservationUser(id){
    return axios.post('/api/reservation/show',{'user_id': id});
}

export function setReservationHouse(arrivalDay, departureDay, taxes, arrivalTime, departureTime, subtotal, total, user_id, house_id){
    return axios.post('/api/reservation',{
        'arrivalDay' : arrivalDay,
        'departureDay' : departureDay,
        'taxes' : taxes,
        'arrivalTime' : arrivalTime,
        'departureTime' : departureTime,
        'subtotal' : subtotal,
        'total' : total,
        'user_id' : user_id,
        'house_id' : house_id
    })
}

export function sendEmail(email, nameHouse, arrivalDay, departureDay, arrivalTime, departureTime, subtotal, taxes, totalPrices){
    return axios.post('/api/email',{
        'email':email,
        'nameHouse':nameHouse,
        'arrivalDay':arrivalDay,
        'departureDay':departureDay,
        'arrivalTime':arrivalTime,
        'departureTime':departureTime,
        'subtotal':subtotal,
        'taxes':taxes,
        'totalPrices':totalPrices
    })
}

export function deleteReservation(reservation){
    return axios.post('/api/destroy' ,{'id':reservation} );
}

export function deleteHouse(house){
    return axios.post('/api/destroyHouse' ,{'id':house} );
}

export function loginAdministrador(name,password){
    return axios.post('/api/loginAdministrador',{'name': name, 'password': password});
}

export function setHouse(data){
    return axios.post('/api/storeHouse',data);
}

export function editHouse(data){
    return axios.post('/api/editHouse',data);
}

export function setCarousel(data){
    return axios.post('/api/storeCarousel',data);
}