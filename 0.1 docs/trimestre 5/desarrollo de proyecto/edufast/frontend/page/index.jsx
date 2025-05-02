import React from "react";
import "bootstrap/dist/css/bootstrap.min.css";
import "@fortawesome/fontawesome-free/css/all.min.css";

const Navbar = () => {
  return (
    <header className="navbar navbar-expand-lg shadow fixed-top" style={{ backgroundColor: "#7f7b82" }}>
      <div className="container d-flex justify-content-between align-items-left">
        <a className="navbar-brand fw-bold d-flex align-items-center gap-2" href="#" style={{ color: "white" }}>
          EDUFAST
        </a>
        <button className="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
          <span className="navbar-toggler-icon"></span>
        </button>
        <div className="collapse navbar-collapse" id="navbarNav">
          <div className="navbar-nav ms-auto fs-5">
            <a href="#inicio" className="nav-link active" style={{ color: "white" }}>Inicio</a>
            <a href="#pagina" className="nav-link active" style={{ color: "white" }}>Pagina</a>
            <a href="#eventos" className="nav-link active" style={{ color: "white" }}>Eventos</a>
            <a href="#noticias" className="nav-link active" style={{ color: "white" }}>Noticias</a>
            <a href="#grupo" className="nav-link active" style={{ color: "white" }}>Grupo</a>
          </div>
        </div>
      </div>
    </header>
  );
};

const Home = () => {
  return (
    <section className="container-fluid text-center py-5" id="inicio">
      <div className="row align-items-center">
        <div className="col-lg-6 text-lg-start">
          <h1 className="text-dark"><b><i>BIENVENIDO A EDUFAST</i></b></h1>
        </div>
        <div className="col-lg-6 text-center">
          <img src="../edufast/imagenes/logo.png" className="rounded img-fluid" alt="logo" style={{ maxWidth: "420px" }} />
        </div>
        <div className="col-md-6 mx-auto text-center mt-4">
          <a href="inicio2.php" className="btn btn-dark btn-lg">Iniciar Sesión</a>
        </div>
      </div>
    </section>
  );
};

const PageInfo = () => {
  return (
    <section className="container my-5" id="pagina">
      <div className="row">
        <div className="col-md-6 p-3">
          <img src="imagenes/paginaadmin.png" alt="Vista Administrador" className="img-fluid" />
        </div>
        <div className="col-md-6 p-3">
          <h1 className="text-center">VISTA REGISTRO</h1>
          <p><i>Edufast es una plataforma diseñada para facilitar el acceso a información educativa...</i></p>
        </div>
      </div>
    </section>
  );
};

const Footer = () => {
  return (
    <footer className="bg-dark text-white text-center p-4">
      <p>Todos los derechos reservados <br /> EDUFAST</p>
    </footer>
  );
};

const App = () => {
  return (
    <>
      <Navbar />
      <main>
        <Home />
        <PageInfo />
      </main>
      <Footer />
    </>
  );
};

export default App;