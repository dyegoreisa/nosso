package br.com.biavan.util;

public enum TipoOsseo {
	
	FINO("Fino"), MEDIO("Médio"), LARGO("Largo");
	
	private String tipo;
	
	TipoOsseo (String tipo) {
		this.tipo = tipo;
	}
	
	public String getTipoOsseo() {
		return tipo;
	}

}
