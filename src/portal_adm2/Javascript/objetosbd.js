function select_afp(funcion) {
    this.idAfp = $("#afp_idAfp");
    this.Nombre = $("#afp_Nombre");
    this.Rut = $("#afp_Rut");
    this.Porcentaje = $("#afp_Porcentaje");
    this.Estado = $("#afp_Estado");
    this.funcion = funcion;

    this.convertir = function convertir() {
        this.idAfp = this.idAfp.val();
        this.Nombre = this.Nombre.val();
        this.Rut = this.Rut.val();
        this.Porcentaje = this.Porcentaje.val();
        this.Estado = this.Estado.val();
    };

    this.validar = function validar() {
        var valid = true;

        return valid;
    };
}

function select_ccto(funcion) {
    this.idCentroCosto = $("#ccto_idCentroCosto");
    this.Nombre = $("#ccto_Nombre");
    this.CentroCostoPadre = $("#ccto_CentroCostoPadre");
    this.Fecha = $("#ccto_Fecha");
    this.funcion = funcion;

    this.convertir = function convertir() {
        this.idCentroCosto = this.idCentroCosto.val();
        this.Nombre = this.Nombre.val();
        this.CentroCostoPadre = this.CentroCostoPadre.val();
        this.Fecha = this.Fecha.val();
    };

    this.validar = function validar() {
        return true;
    };
}

function select_empl2(funcion) {
    this.idEmpleado = $("#empl2_idEmpleado");
    this.Contrato_idContrato = $("#empl2_Contrato_idContrato");
    this.Afp_idAfp = $("#empl2_Afp_idAfp");
    this.PrevisionSalud_idPrevision = $("#empl2_PrevisionSalud_idPrevision");
    this.PrevisionPorcentage = $("#empl2_PrevisionPorcentage");
    this.Departamento_idDepartamento = $("#empl2_Departamento_idDepartamento");
    this.CentroCosto_idCentroCosto = $("#empl2_CentroCosto_idCentroCosto");

    this.funcion = funcion;

    this.convertir = function convertir() {
        this.idEmpleado = this.idEmpleado.val();
        this.Contrato_idContrato = this.Contrato_idContrato.val();
        this.Afp_idAfp = this.Afp_idAfp.val();
        this.PrevisionSalud_idPrevision = this.PrevisionSalud_idPrevision.val();
        this.PrevisionPorcentage = this.PrevisionPorcentage.val();
        this.Departamento_idDepartamento = this.Departamento_idDepartamento.val();
        this.CentroCosto_idCentroCosto = this.CentroCosto_idCentroCosto.val();
    };

    this.validar = function validar() {
        return true;
    };
}

function select_contrato(funcion) {
    this.idContrato = $("#contrato_idContrato");
    this.idEmpleado = $("#contrato_idEmpleado");
    this.idCiudad = $("#contrato_idCiudad");
    this.Fecha = $("#contrato_Fecha");
    this.Cargo = $("#contrato_Cargo");
    this.DiaInicioTrabajo = $("#contrato_DiaInicioTrabajo");
    this.DiaFinTrabajo = $("#contrato_DiaFinTrabajo");
    this.HoraInicio = $("#contrato_HoraInicio");
    this.HoraFin = $("#contrato_HoraFin");
    this.DescansoInicio = $("#contrato_DescansoInicio");
    this.DescansoFin = $("#contrato_DescansoFin");
    this.Sueldo = $("#contrato_Sueldo");
    this.Finiquito_idFiniquito = $("#contrato_Finiquito_idFiniquito");
    this.TipoContrato = $("#contrato_TipoContrato");
    this.funcion = funcion;

    this.convertir = function convertir() {
        this.idContrato = this.idContrato.val();
        this.idEmpleado = this.idEmpleado.val();
        this.idCiudad = this.idCiudad.val();
        this.Fecha = this.Fecha.val();
        this.Cargo = this.Cargo.val();
        this.DiaInicioTrabajo = this.DiaInicioTrabajo.val();
        this.DiaFinTrabajo = this.DiaFinTrabajo.val();
        this.HoraInicio = this.HoraInicio.val();
        this.HoraFin = this.HoraFin.val();
        this.DescansoInicio = this.DescansoInicio.val();
        this.DescansoFin = this.DescansoFin.val();
        this.Sueldo = this.Sueldo.val();
        this.Finiquito_idFiniquito = this.Finiquito_idFiniquito.val();
        this.TipoContrato = this.TipoContrato.val();
    };

    this.validar = function validar() {
        return true;
    };
}