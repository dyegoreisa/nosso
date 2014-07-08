package br.com.biavan.util;

public enum Sexo {

	MASCULINO("Masculino"), FEMININO("Feminino");
	
	private String sexo;
	
	Sexo (String sexo) {
		this.sexo = sexo;
	}
	
	public String getSexo() {
		return sexo;
	}
}
