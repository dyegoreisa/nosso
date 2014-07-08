package br.com.biavan.model;

import javax.persistence.Entity;
import javax.persistence.GeneratedValue;
import javax.persistence.Id;
import javax.persistence.Table;

import br.com.biavan.util.Sexo;
import br.com.biavan.util.TipoOsseo;

@Entity
@Table(name = "base_imc")
public class BaseImc {

	@Id
	@GeneratedValue
	private long id;
	
	private Sexo sexo;
	
	private TipoOsseo tipoOsseo;
	
	private double imc;

	public long getId() {
		return id;
	}

	public void setId(long id) {
		this.id = id;
	}

	public Sexo getSexo() {
		return sexo;
	}

	public void setSexo(Sexo sexo) {
		this.sexo = sexo;
	}

	public TipoOsseo getTipoOsseo() {
		return tipoOsseo;
	}

	public void setTipoOsseo(TipoOsseo tipoOsseo) {
		this.tipoOsseo = tipoOsseo;
	}

	public double getImc() {
		return imc;
	}

	public void setImc(double imc) {
		this.imc = imc;
	}
	
	
}
