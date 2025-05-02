import React, { useEffect, useState } from 'react';
import axios from 'axios';
import 'bootstrap/dist/css/bootstrap.min.css';
import './principal.css';
import './imagenes/logo.png';

const App = () => {
  const [publicacionesEventos, setPublicacionesEventos] = useState([]);
  const [publicacionesNoticias, setPublicacionesNoticias] = useState([]);

  useEffect(() => {
    const fetchData = async () => {
      try {
        const eventosResponse = await axios.get('/api/public_eventos');
        setPublicacionesEventos(eventosResponse.data);

        const noticiasResponse = await axios.get('/api/public_noticias');
        setPublicacionesNoticias(noticiasResponse.data);
      } catch (error) {
        console.error('Error fetching data:', error);
      }
    };

    fetchData();
  }, []);

  return (
    <div>
      <header className="containerNav navbar navbar-expand-lg shadow fixed-top" style={{ backgroundColor: '#7f7b82' }}>
        <div className="container d-flex justify-content-between align-items-left">
          <a className="navbar-brand fw-bold d-flex align-items-center gap-2" href="#" style={{ color: 'white' }}>
            <span style={{ color: 'white' }}>EDUFAST</span>
          </a>
          <button className="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span className="navbar-toggler-icon"></span>
          </button>
          <div className="collapse navbar-collapse" id="navbarNav">
            <div className="navbar-nav ms-auto fs-5">
              <a href="#inicio" className="nav-link active" style={{ color: 'white' }}>Inicio</a>
              <a href="#pagina" className="nav-link active" style={{ color: 'white' }}>Pagina</a>
              <a href="#eventos" className="nav-link active" style={{ color: 'white' }}>Eventos</a>
              <a href="#noticias" className="nav-link active" style={{ color: 'white' }}>Noticias</a>
              <a href="#grupo" className="nav-link active" style={{ color: 'white' }}>Grupo</a>
            </div>
          </div>
        </div>
      </header>

      <main>
        <section className="ParteSuperior container-fluid" id="inicio">
          <div className="row align-items-center logo">
            <div className="col-lg-6 col-md-12 text-center text-lg-start">
              <h1 className="text-dark"><b><i>BIENVENIDO A EDUFAST</i></b></h1>
            </div>
            <div className="col-lg-6 col-md-12 text-center">
              <img src="../edufast/imagenes/logo.png" className="rounded img-fluid" alt="logo" style={{ maxWidth: '420px', height: 'auto' }} />
            </div>
            <div className="row justify-content-center">
              <div className="col-md-6 text-center mb-5">
                <a href="inicio2.php" className="btn btn-dark btn-lg" role="button">Iniciar Sesión</a>
              </div>
            </div>
          </div>
        </section>

        <section className="pagina" id="pagina">
          <section className="conteinerPagina">
            <figure className="imagenPage col-6 p-3">
              <img src="imagenes/paginaadmin.png" alt="imagen" width="1900px" />
            </figure>
            <section className="informacionPage p-3">
              <h1 className="text-center">VISTA REGISTRO</h1>
              <p><i>Edufast es una plataforma diseñada para facilitar el acceso a información educativa, donde podrás encontrar cursos, grados actividades y los logros asociados a ellas. También podrás consultar la asistencia y las materias disponibles.Dependiendo de tu rol o profesión, tendrás acceso a diferentes funcionalidades y estilos personalizados en las páginas. Es un software intuitivo, fácil de usar y adaptado para cubrir diversas necesidades, asegurando una experiencia agradable para todos los usuarios.</i></p>
            </section>
          </section>
          <section className="conteinerPagina reverse">
            <figure className="imagenPage col-6 p-3">
              <img src="imagenes/paginaestudent.png" alt="imagen" width="1900px" />
            </figure>
            <section className="informacionPage">
              <h1 className="text-center">VISTA REGISTRO</h1>
              <p><i>Edufast es una plataforma diseñada para facilitar el acceso a información educativa, donde podrás encontrar cursos, grados actividades y los logros asociados a ellas. También podrás consultar la asistencia y las materias disponibles.Dependiendo de tu rol o profesión, tendrás acceso a diferentes funcionalidades y estilos personalizados en las páginas. Es un software intuitivo, fácil de usar y adaptado para cubrir diversas necesidades, asegurando una experiencia agradable para todos los usuarios.</i></p>
            </section>
          </section>
        </section>

        <section className="eventos" id="eventos">
          <div id="carouselExampleCaptions" className="carousel slide">
            <div className="carousel-indicators">
              {publicacionesEventos.map((_, index) => (
                <button key={index} type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to={index} className={index === 0 ? 'active' : ''} aria-current={index === 0 ? 'true' : 'false'} aria-label={`Slide ${index + 1}`}></button>
              ))}
            </div>
            <div className="carousel-inner">
              {publicacionesEventos.map((publicacion, index) => (
                <div key={index} className={`carousel-item ${index === 0 ? 'active' : ''} c-item`}>
                  <img src={`../administrador/imagenes/${publicacion.img}`} className="d-block w-100 c-img" alt="..." />
                  <div className="carousel-caption d-none d-md-block">
                    <h5>{publicacion.evento}</h5>
                    <p className="text-light">{publicacion.fecha_evento}</p>
                    <p>{publicacion.nombres}</p>
                  </div>
                </div>
              ))}
            </div>
            <button className="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
              <span className="carousel-control-prev-icon" aria-hidden="true"></span>
              <span className="visually-hidden">Previous</span>
            </button>
            <button className="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
              <span className="carousel-control-next-icon" aria-hidden="true"></span>
              <span className="visually-hidden">Next</span>
            </button>
          </div>
        </section>

        <section className="noticias" id="noticias">
          {publicacionesNoticias.map((publicacion, index) => (
            <article key={index} className="articulo">
              <header>
                <h2>{publicacion.titulo}</h2>
              </header>
              <p>{publicacion.info}</p>
              <footer>
                <p>Atentamente,</p>
                <p><strong>{publicacion.nombres} {publicacion.apellidos}</strong></p>
              </footer>
            </article>
          ))}
        </section>

        <section id="grupo" className="equipo col-md-12">
          <h2 className="text-center"><b>EQUIPO</b></h2>
          <section className="containerequipo">
            <section className="cardequipo">
              <figure className="imgequipo">
                <img src="https://tse4.mm.bing.net/th?id=OIP.VxnfJYTfgX5SyH8LRiXtVgHaE8&pid=Api&P=0&h=180" alt="equipo" />
              </figure>
              <section className="contentequipo">
                <h2 className="text-center">COORDINADOR</h2>
                <p>Juan Pablo Peña</p>
                <p>314457654</p>
                <p>JuanPeña@Cedidsanpablo.edu.co</p>
              </section>
            </section>
            <section className="cardequipo">
              <figure className="imgequipo">
                <img src="https://tse3.mm.bing.net/th?id=OIP.mWTS6Gn1W3c2fHLvV3e9yQHaJ4&pid=Api&P=0&h=180" alt="equipo" />
              </figure>
              <section className="contentequipo">
                <h2 className="text-center">Rectora</h2>
                <p>Lusia Fernanda Perez Castañeda</p>
                <p>321908765</p>
                <p>LuisaPerez@Cedidsanpablo.edu.co</p>
              </section>
            </section>
            <section className="cardequipo">
              <figure className="imgequipo">
                <img src="https://tse3.mm.bing.net/th?id=OIP.RobrDmv-954D05PRx2UHsQHaEG&pid=Api&P=0&h=180" alt="equipo" />
              </figure>
              <section className="contentequipo">
                <h2 className="text-center">SECRETARIA</h2>
                <p>Maria Rodrigez</p>
                <p>3213675499</p>
                <p>maria@Cedidsanpablo.edu.co</p>
              </section>
            </section>
          </section>
        </section>
      </main>

      <footer className="footer">
        <div className="containerfooter">
          <div className="footer-row">
            <div className="footer-links">
              <h4>SEDES</h4>
              <ul>
                <li>sede A</li>
                <li>Cl. 66 Sur #78-2, Bogotá</li>
                <li>sede B</li>
                <li>Cl. 65j Sur, Bogotá</li>
                <li>sede C</li>
                <li>Cl. 70 Bis Sur, Bogotá</li>
              </ul>
            </div>
            <div className="footer-links">
              <h4>INFORMACION</h4>
              <ul>
                <li>telefono:<br />7757545</li>
                <li>telefono:<br />7765276</li>
                <li>telefono:<br />7750283</li>
                <li>direccion:<br />CR 77 L # 65 J - 73 sur</li>
              </ul>
            </div>
            <div className="footer-links">
              <h4>ATENCIÒN</h4>
              <ul>
                <li>lunes a viernes</li>
                <li>8am - 12pm</li>
                <li>2pm - 4pm</li>
              </ul>
            </div>
            <div className="footer-links">
              <h4>CONTACTANOS</h4>
              <div className="social-link">
                <a href="https://www.facebook.com/cedid.sanpablo.3?locale=es_LA" className="icon"><i className="fab fa-facebook-f"></i></a>
                <a href="https://www.instagram.com/plumapaulista/" className="icon"><i className="fab fa-instagram"></i></a>
                <a href="https://x.com/Cedidsanpablo" className="icon"><i className="fab fa-twitter"></i></a>
                <a href="mailto:cedidsanpablobosa7@educacionbogota.edu.co" className="icon"><i className="fab fa-google"></i></a>
              </div>
            </div>
          </div>
          <p>Todos los derechos reservados <br />EDUFAST</p>
        </div>
      </footer>
    </div>
  );
};

export default App;