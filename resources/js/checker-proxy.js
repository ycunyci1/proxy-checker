import axios from "axios";

document.addEventListener("DOMContentLoaded", function () {
    const preloaderWrapper = document.querySelector('#preloader-wrapper');
    const overlay = document.getElementById('preloader-overlay');

    const form = document.querySelector('.checker__wrapper');

    const btn = form.querySelector('.checker__btn');

    btn.addEventListener('click', () => {
        overlay.style.display = 'flex'
        preloaderWrapper.classList.remove('d-none');
        preloaderWrapper.classList.add('d-flex');
        const content = form.querySelector('#checker').value;
        let intervalId;
        axios.post('/api/check', {
            'proxies': content
        }).then((response
        ) => {
            setTimeout(() => {
                intervalId = setInterval(function () {
                    axios.post(`/api/check-process`, {
                        'key': response.data.key,
                        'count': response.data.count,
                    })
                        .then(response => {
                            if (response.status !== 202) {
                                preloaderWrapper.classList.remove('d-flex');
                                preloaderWrapper.classList.add('d-none');
                                const successWrapper = document.querySelector('.results__wrapper')
                                const table = successWrapper.querySelector('table')
                                const tbody = table.querySelector('tbody')
                                tbody.innerHTML = ''
                                const counterWrapper = successWrapper.querySelector('.result__counter')
                                counterWrapper.innerHTML = ''
                                const successResults = document.createElement('div');
                                const failedResults = document.createElement('div');
                                successResults.innerHTML = `Количество рабочих proxy: ${response.data.results.successful}`
                                failedResults.innerHTML = `Количество нерабочих proxy: ${response.data.results.failed}`
                                Object.values(response.data.proxies).forEach(proxy => {
                                    const td = document.createElement('tr');
                                    td.innerHTML = proxy.work
                                        ? `<td>${proxy.ip_port}</td>
                                           <td>${proxy.type ? proxy.type : null}</td>
                                           <td>${proxy.country}</td>
                                           <td>${proxy.kind ? 'Anonymous' : 'Transparent'}</td>
                                           <td>${proxy.work ? 'Works' : 'Doesnt work'}</td>
                                           <td>${proxy.timing}</td>
                                           <td>${proxy.query}</td>`
                                        : `<td>${proxy.ip_port}</td>
                                           <td>-</td>
                                           <td>-</td>
                                           <td>-</td>
                                           <td>Doesnt work</td>
                                           <td>-</td>
                                           <td>-</td>`
                                    tbody.appendChild(td);
                                });
                                counterWrapper.appendChild(successResults)
                                counterWrapper.appendChild(failedResults)
                                table.style.display = 'block';
                                preloaderWrapper.style.display = 'none';
                                clearInterval(intervalId);
                                updateProgressBar(0);
                                overlay.style.display = 'none'
                            } else {
                                updateProgressBar(100 * response.data.currentCount / response.data.maxCount);
                            }
                        })
                }, 2000);
            }, 5000);
        }).catch((error) => {
        });
    })
    function updateProgressBar(progress) {
        let progressBar = document.querySelector('.progress-bar');
        progressBar.style.width = progress + '%';
        progressBar.setAttribute('aria-valuenow', progress);
    }
});


