import React from 'react';
import { SafeAreaView, View, Text, Image, ScrollView, StyleSheet } from 'react-native';

const EquipoScreen = () => {
    const equipo = [
        {
            cargo: 'COORDINADOR',
            nombre: 'Juan Pablo Peña',
            telefono: '314457654',
            email: 'JuanPeña@Cedidsanpablo.edu.co',
            imagen: 'https://tse4.mm.bing.net/th?id=OIP.VxnfJYTfgX5SyH8LRiXtVgHaE8&pid=Api&P=0&h=180',
        },
        {
            cargo: 'RECTORA',
            nombre: 'Luisa Fernanda Perez Castañeda',
            telefono: '321908765',
            email: 'LuisaPerez@Cedidsanpablo.edu.co',
            imagen: 'https://tse3.mm.bing.net/th?id=OIP.mWTS6Gn1W3c2fHLvV3e9yQHaJ4&pid=Api&P=0&h=180',
        },
        {
            cargo: 'SECRETARIA',
            nombre: 'Maria Rodrigez',
            telefono: '3213675499',
            email: 'maria@Cedidsanpablo.edu.co',
            imagen: 'https://tse3.mm.bing.net/th?id=OIP.RobrDmv-954D05PRx2UHsQHaEG&pid=Api&P=0&h=180',
        },
    ];

    return (
        <SafeAreaView style={styles.container}>
            <Text style={styles.title}>EQUIPO</Text>
            <ScrollView contentContainerStyle={styles.cardContainer}>
                {equipo.map((persona, index) => (
                    <View key={index} style={styles.card}>
                        <Image source={{ uri: persona.imagen }} style={styles.image} />
                        <View style={styles.cardContent}>
                            <Text style={styles.cargo}>{persona.cargo}</Text>
                            <Text>{persona.nombre}</Text>
                            <Text>{persona.telefono}</Text>
                            <Text>{persona.email}</Text>
                        </View>
                    </View>
                ))}
            </ScrollView>
        </SafeAreaView>
    );
};

const styles = StyleSheet.create({
    container: {
        flex: 1,
        padding: 20,
        backgroundColor: '#f5f5f5',
    },
    title: {
        fontSize: 24,
        textAlign: 'center',
        fontWeight: 'bold',
        marginBottom: 20,
    },
    cardContainer: {
        alignItems: 'center',
    },
    card: {
        backgroundColor: '#fff',
        width: '90%',
        marginBottom: 20,
        borderRadius: 10,
        elevation: 3,
        shadowColor: '#000',
        shadowOpacity: 0.1,
        shadowRadius: 4,
        shadowOffset: { width: 0, height: 2 },
    },
    image: {
        width: '100%',
        height: 150,
        borderTopLeftRadius: 10,
        borderTopRightRadius: 10,
    },
    cardContent: {
        padding: 15,
        alignItems: 'center',
    },
    cargo: {
        fontWeight: 'bold',
        fontSize: 16,
        marginBottom: 8,
    },
});

export default EquipoScreen;
