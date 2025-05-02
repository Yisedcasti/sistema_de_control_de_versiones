import React from 'react';
import { View, Text, TouchableOpacity, StyleSheet, ScrollView } from 'react-native';
import Icon from 'react-native-vector-icons/FontAwesome5';
import { useNavigation } from '@react-navigation/native';

const options = [
  {
    icon: 'user-plus',
    title: 'Profesor',
    link: 'RegistrosProfesor',
  },
  {
    icon: 'check-circle',
    title: 'Materias',
    link: 'Materias',
  },
  {
    icon: 'book',
    title: 'Actividades',
    link: 'Actividades',
  },
  {
    icon: 'user-plus',
    title: 'Alumno',
    link: 'RegistrosAlumno',
  },
  {
    icon: 'calendar-alt',
    title: 'Jornadas',
    link: 'Jornadas',
  },
  {
    icon: 'graduation-cap',
    title: 'Grados',
    link: 'Grados',
  },
];

export default function Dashboard({ route }) {
  const navigation = useNavigation();

  return (
    <View style={styles.container}>
      <Text style={styles.title}>Bienvenido</Text>
      <Text style={styles.subtitle}>
        Aquí puedes gestionar estudiantes, profesores, materias, grados, y más.
      </Text>

      <ScrollView contentContainerStyle={styles.grid}>
        {options.map((item, index) => (
          <TouchableOpacity
            key={index}
            style={styles.card}
            onPress={() => navigation.navigate(item.link)}
          >
            <Icon name={item.icon} size={36} color="#333" />
            <Text style={styles.cardTitle}>{item.title}</Text>
          </TouchableOpacity>
        ))}
      </ScrollView>
    </View>
  );
}

const styles = StyleSheet.create({
  container: {
    padding: 20,
    paddingTop: 50,
    flex: 1,
    backgroundColor: '#f9f9f9',
  },
  title: {
    fontSize: 22,
    fontWeight: 'bold',
    marginBottom: 10,
  },
  subtitle: {
    color: '#555',
    marginBottom: 20,
  },
  grid: {
    flexDirection: 'row',
    flexWrap: 'wrap',
    justifyContent: 'space-between',
  },
  card: {
    width: '47%',
    backgroundColor: '#fff',
    padding: 20,
    marginBottom: 20,
    alignItems: 'center',
    borderRadius: 12,
    elevation: 3,
  },
  cardTitle: {
    marginTop: 10,
    fontWeight: '600',
  },
});
